<?php
function clientGoogle()
{
  $client_id = "30871858396-rl40335apbefppa9hljq0ai9pab49hhs.apps.googleusercontent.com";
  $client_secret = "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";
  $redirect_uri = "http://localhost/libary_manage/?controller=user&action=login";
  $client = new Google_Client();
  $client->setClientId($client_id);
  $client->setClientSecret($client_secret);
  $client->setRedirectUri($redirect_uri);
  $client->addScope("email");
  $client->addScope("profile");
  return $client;
}
?>