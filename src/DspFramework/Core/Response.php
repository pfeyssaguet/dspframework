<?php

namespace DspFramework\Core;

class Response
{
	private $code = 200;

	private $contentType = "text/html";

	private $content;

	public function __construct($content)
	{
		$this->content = $content;
	}

	public function run() {
		header('Content-type: '.$contentType);
		echo $this->content;
	}
}
