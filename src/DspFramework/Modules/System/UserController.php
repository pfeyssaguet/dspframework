<?php

namespace DspFramework\Modules\System;

use DspFramework\Core\Controller;
use DspFramework\Core\Response;

class UserController extends Controller
{
	protected function defaultAction()
	{
		$response = new Response("hello user");
		return $response;
	}

	protected function viewAction($userId)
	{

	}

	protected function editAction($userId)
	{

	}
}
