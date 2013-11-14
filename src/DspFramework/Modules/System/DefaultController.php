<?php

namespace DspFramework\Modules\System;

use DspFramework\Core\Controller;
use DspFramework\Core\Response;

class DefaultController extends Controller
{
	protected function defaultAction()
	{
		return new Response("default system controller");
	}
}
