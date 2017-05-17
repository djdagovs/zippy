<?php
// namespace MZOG;

class ZippyshareFile
{
    private $url;

    private $www;

    private $file;

    public function __construct($url)
    {
        $this->url = $url;

        preg_match('/https?:\/\/www([0-9]+)\.zippyshare\.com\/v\/([0-9a-zA-Z]+)\/file.html/', $url, $matches);

        $this->www = $matches[1];

        $this->file = $matches[2];
    }

    public function getWWW()
    {
        return $this->www;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function downloadTitle()
    {
        $str = file_get_contents($this->url);

        $str = trim(preg_replace('/\s+/', ' ', $str)); // supports line breaks inside <title>
        preg_match("/\<title\>Zippyshare\.com - (.*)\<\/title\>/i", $str, $title); // ignore case
        return $title[1];
    }
}
