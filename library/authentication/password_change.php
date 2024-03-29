<?php
require_once("$srcdir/authentication/common_operations.php");


function test_password_strength($pwd, &$errMsg)
{
    $require_strong=$GLOBALS['secure_password'] !=0;
    if ($require_strong) {
        if (strlen($pwd)<8) {
            $errMsg=xl("Password too short. Minimum 8 characters required.");
            return false;
        }

        $features=0;
        $reg_security=array("/[a-z]+/","/[A-Z]+/","/\d+/","/[\W_]+/");
        foreach ($reg_security as $expr) {
            if (preg_match($expr, $pwd)) {
                $features++;
            }
        }

        if ($features<3) {
            $errMsg=xl("Password does not meet minimum requirements and should contain at least three of the four following items: A number, a lowercase letter, an uppercase letter, a special character (Not a leter or number).");
            return false;
        }
    }

    return true;
}


function update_password($activeUser, $targetUser, &$currentPwd, &$newPwd, &$errMsg, $create = false, $insert_sql = "", $new_username = null, &$newid = null)
{
    $userSQL="SELECT ".implode(",", array(COL_PWD,COL_SALT,COL_PWD_H1,COL_SALT_H1,COL_PWD_H2,COL_SALT_H2))
            ." FROM ".TBL_USERS_SECURE
            ." WHERE ".COL_ID."=?";
    $userInfo=privQuery($userSQL, array($targetUser));
    
    // Verify the active user's password
    $changingOwnPassword = $activeUser==$targetUser;
    // True if this is the current user changing their own password
    if ($changingOwnPassword) {
        if ($create) {
            $errMsg=xl("Trying to create user with existing username!");
            return false;
        }

        // If this user is changing his own password, then confirm that they have the current password correct
        $hash_current = oemr_password_hash($currentPwd, $userInfo[COL_SALT]);
        if (($hash_current!=$userInfo[COL_PWD])) {
            $errMsg=xl("Incorrect password!");
            return false;
        }
    } else {
        // If this is an administrator changing someone else's password, then check that they have the password right
        if ($GLOBALS['use_active_directory']) {
            $valid = active_directory_validation($_SESSION['authUser'], $currentPwd);
            if (!$valid) {
                $errMsg=xl("Incorrect password!");
                return false;
            } else {
                $newPwd = md5(uniqid());
            }
        } else {
            $adminSQL=" SELECT ".implode(",", array(COL_PWD,COL_SALT))
                      ." FROM ".TBL_USERS_SECURE
                      ." WHERE ".COL_ID."=?";
            $adminInfo=privQuery($adminSQL, array($activeUser));
            $hash_admin = oemr_password_hash($currentPwd, $adminInfo[COL_SALT]);
            if ($hash_admin!=$adminInfo[COL_PWD]) {
                $errMsg=xl("Incorrect password!");
                return false;
            }
        }

        if (!acl_check('admin', 'users')) {
            $errMsg=xl("Not authorized to manage users!");
            return false;
        }
    }

    // End active user check

    
    //Test password validity
    if (strlen($newPwd)==0) {
        $errMsg=xl("Empty Password Not Allowed");
        return false;
    }

    if (!test_password_strength($newPwd, $errMsg)) {
        return false;
    }

    // End password validty checks

    if ($userInfo===false) {
        // No userInfo means either a new user, or an existing user who has not been migrated to blowfish yet
        // In these cases don't worry about password history
        if ($create) {
            privStatement($insert_sql, array());
            $getUserID=  " SELECT ".COL_ID
                        ." FROM ".TBL_USERS
                        ." WHERE ".COL_UNM."=?";
                $user_id=privQuery($getUserID, array($new_username));
                initializePassword($new_username, $user_id[COL_ID], $newPwd);
                $newid=$user_id[COL_ID];
        } else {
            $getUserNameSQL="SELECT ".COL_UNM
                ." FROM ".TBL_USERS
                ." WHERE ".COL_ID."=?";
            $unm=privQuery($getUserNameSQL, array($targetUser));
            if ($unm===false) {
                $errMsg=xl("Unknown user id:".$targetUser);
                return false;
            }

            initializePassword($unm[COL_UNM], $targetUser, $newPwd);
            purgeCompatabilityPassword($unm[COL_UNM], $targetUser);
        }
    } else { // We are trying to update the password of an existing user

        if ($create) {
            $errMsg=xl("Trying to create user with existing username!");
            return false;
        }
        
        $forbid_reuse=$GLOBALS['password_history'] != 0;
        if ($forbid_reuse) {
            // password reuse disallowed
            $hash_current = oemr_password_hash($newPwd, $userInfo[COL_SALT]);
            $hash_history1 = oemr_password_hash($newPwd, $userInfo[COL_SALT_H1]);
            $hash_history2 = oemr_password_hash($newPwd, $userInfo[COL_SALT_H2]);
            if (($hash_current==$userInfo[COL_PWD])
                ||($hash_history1==$userInfo[COL_PWD_H1])
                || ($hash_history2==$userInfo[COL_PWD_H2])) {
                $errMsg=xl("Reuse of three previous passwords not allowed!");
                return false;
            }
        }
        
        // Everything checks out at this point, so update the password record
        $newSalt = oemr_password_salt();
        $newHash = oemr_password_hash($newPwd, $newSalt);
        $updateParams=array();
        $updateSQL= "UPDATE ".TBL_USERS_SECURE;
        $updateSQL.=" SET ".COL_PWD."=?,".COL_SALT."=?";
        array_push($updateParams, $newHash);
        array_push($updateParams, $newSalt);
        if ($forbid_reuse) {
            $updateSQL.=",".COL_PWD_H1."=?".",".COL_SALT_H1."=?";
            array_push($updateParams, $userInfo[COL_PWD]);
            array_push($updateParams, $userInfo[COL_SALT]);
            $updateSQL.=",".COL_PWD_H2."=?".",".COL_SALT_H2."=?";
            array_push($updateParams, $userInfo[COL_PWD_H1]);
            array_push($updateParams, $userInfo[COL_SALT_H1]);
        }

        $updateSQL.=" WHERE ".COL_ID."=?";
        array_push($updateParams, $targetUser);
        privStatement($updateSQL, $updateParams);
        
        // If the user is changing their own password, we need to update the session
        if ($changingOwnPassword) {
            $_SESSION['authPass']=$newHash;
        }
    }
   
    if ($GLOBALS['password_expiration_days'] != 0) {
            $exp_days=$GLOBALS['password_expiration_days'];
            $exp_date = date('Y-m-d', strtotime("+$exp_days days"));
            privStatement("update users set pwd_expiration_date=? where id=?", array($exp_date,$targetUser));
    }

    return true;
}
