

function user_data_view_model(username,fname,lname,authGrp)
{
    var self=this;
    self.username=ko.observable(username);
    self.fname=ko.observable(fname);
    self.lname=ko.observable(lname);
    self.authorization_group=ko.observable(authGrp);
    self.messages=ko.observable("");
    return this;

}

function viewPtFinder()
{
    navigateTab(webroot_url+"/interface/main/finder/dynamic_finder.php","fin");
    activateTabByName("fin",true);
}

function viewTgFinder() {

    navigateTab(webroot_url+"/interface/therapy_groups/index.php?method=listGroups","gfn");
    activateTabByName("gfn",true);
}

function viewMessages()
{
    navigateTab(webroot_url+"/interface/main/messages/messages.php?form_active=1","msg");
    activateTabByName("msg",true);
}

function editSettings()
{
    navigateTab(webroot_url+"/interface/super/edit_globals.php?mode=user","msc");
    activateTabByName("msc",true);
}

function changePassword()
{
    navigateTab(webroot_url+"/interface/usergroup/user_info.php","msc");
    activateTabByName("msc",true);
}

function logout()
{
    top.restoreSession();
    top.window.location=webroot_url+"/interface/logout.php";
}
