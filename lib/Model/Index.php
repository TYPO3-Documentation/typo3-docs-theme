<?php

declare(strict_types=1);

namespace T3Docs\Theme\Model;

class Index
{
    private string $chapter;
    private string $entry;
    private bool $important = false;
    private string $url;

    /**
     * @param string $chapter
     * @param string $entry
     * @param bool $important
     * @param string $url
     */
    public function __construct(
        string $chapter,
        string $entry,
        string $url,
        bool $important = false
    ) {
        $this->chapter = $chapter;
        $this->entry = $entry;
        $this->important = $important;
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getChapter(): string
    {
        return $this->chapter;
    }

    /**
     * @return string
     */
    public function getEntry(): string
    {
        return $this->entry;
    }

    /**
     * @return bool
     */
    public function isImportant(): bool
    {
        return $this->important;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    public static function compare(Index $a, Index $b) : int
    {
        return strtolower($a->chapter.$a->entry) <=> strtolower($b->chapter.$a->entry);
    }
}