<?php
/**
 * Created by PhpStorm.
 * User: abellana
 * Date: 03/08/2018
 * Time: 12:39 AM
 */

namespace App\Service;


use Michelf\MarkdownInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;

class MarkdownHelper
{
    private $cache;
    private $markdown;
    private $logger;
    private $isDebug;

    public function parse(string $source): string {
        $item = $this->cache->getItem('markdown_' . md5($source));

        if (stripos($source, 'bacon') !== false) {
            $this->logger->info('They are talking about bacon!!.');
        }

        if ($this->isDebug) {
            return $this->markdown->transform($source);
        }

        if (!$item->isHit()) {
            $item->set($this->markdown->transform($source));
            $this->cache->save($item);
        }

        return $item->get();
    }

    public function __construct(AdapterInterface $cache, MarkdownInterface $markdown, LoggerInterface $markdownLogger, bool $isDebug)
    {
        $this->cache = $cache;
        $this->markdown = $markdown;
        $this->logger = $markdownLogger;
        $this->isDebug = $isDebug;
    }

}