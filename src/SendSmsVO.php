<?php
namespace mghddev\asanak;

/**
 * Class SendSmsVO
 * @package mghddev\asanak
 */
class SendSmsVO
{
    /**
     * @var string
     */
    private string $source;

    /**
     * @var array
     */
    private array $destination;

    /**
     * @var string
     */
    private string $message;

    /**
     * @return string
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * @param string $source
     * @return $this
     */
    public function setSource(string $source): SendSmsVO
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @return array
     */
    public function getDestination(): array
    {
        return $this->destination;
    }

    /**
     * @param array $destination
     * @return $this
     */
    public function setDestination(array $destination): SendSmsVO
    {
        $this->destination = $destination;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return $this
     */
    public function setMessage(string $message): SendSmsVO
    {
        $this->message = $message;
        return $this;
    }
}