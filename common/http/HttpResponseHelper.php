<?php
/**
 * HttpResponseHelper
 *
 */

namespace OpenEMR\Common\Http;

class HttpResponseHelper
{
    public static function send($statusCode, $payload, $serializationStrategy)
    {
        $response = null;

        if (method_exists($payload, 'toSerializedObject')) {
            $payload = $payload->toSerializedObject();
        }

        switch ($serializationStrategy) {
            case 'JSON':
                $messageObject = null;
                if (is_string($payload)) {
                    $messageObject = new \stdClass();
                    $messageObject->message = $payload;
                }

                header("Content-Type: application/json; charset=utf-8");
                if (!empty($messageObject)) {
                    $response = json_encode($messageObject);
                } else {
                    $response = json_encode($payload);
                }
                break;
        }

        header("Expires: on, 01 Jan 1970 00:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        http_response_code($statusCode);

        echo $response;
    }
}
