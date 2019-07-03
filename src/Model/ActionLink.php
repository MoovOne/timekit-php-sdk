<?php

namespace MoovOne\TimekitPhpSdk\Model;

/**
 * Class Availability
 * @package MoovOne\TimekitPhpSdk\Model
 */
class ActionLink
{
    public const BASE_URL = 'https://api.timekit.io/v2/bookings/';

    public function generateActionLink(string $apiKey, string $booking_id, string $action, string $redirect_url)
    {
        $header = json_encode(array('alg' => 'HS256', 'typ' => 'JWT'));
        $payload = json_encode(array(
            "booking_id" => $booking_id,
            "action" => $action
        ));

        // Encode Header to Base64Url String
        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));

        // Encode Payload to Base64Url String
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
        // Create Signature Hash
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $apiKey, true);
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
        $jwt = $base64UrlHeader . '.' . $base64UrlPayload . '.' . $base64UrlSignature;

        $link = self::BASE_URL . $booking_id . '/external_action/' . $action . '?signature=' . $jwt . '&redirect=' . $redirect_url;
        return $link;
    }
}