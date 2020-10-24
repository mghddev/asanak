<?php
namespace mghddev\asanak;

/**
 * Class iAsanakApiClient
 */
interface iAsanakApiClient
{
    public function sendSms(SendSmsVO $sendSmsVO);

    public function getStatus(array $msgIDs);
}