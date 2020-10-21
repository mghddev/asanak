<?php
namespace mghddev\asanak\Constant;

/**
 * Class MessageStatus
 * @package mghddev\asanak\Constant
 */
class MessageStatus
{
    const NotFound = -1;
    const InQueue = 1;
    const Pending = 4;
    const Sent = 2;
    const Failed = 5;
    const Success = 6;
    const NotResponse = 7;
    const Reject = 8;
    const SentToDest = 9;
    const PartiallySent = 10;
    const NoMsgID = 11;
    const partiallySuccess = 12;
    const NoDelivery = 13;

}
