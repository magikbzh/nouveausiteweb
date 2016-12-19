<?php

class RustRcon
{
	protected $socket;
	protected $packetId = 0;

	public static $timeout = 1;
	public static $blockingMode = 0;

	const PACKET_TYPE_CMD = 2;
	const PACKET_TYPE_AUTH = 3;
	const PACKET_TYPE_CMD_RESPONSE = 0;
	const PACKET_TYPE_MESSAGE = 4;

	public function __construct($server, $port, $password)
	{
		$this->connect($server, $port, $password);
	}

	protected function connect($server, $port, $password)
	{
		$this->socket = @fsockopen("tcp://" . $server, $port, $error, $errorstring);

		if ($error !== 0 || !empty($errorstring))
		{
			throw new Exception("Connection failed (" . $error . "): " . $errorstring);
		}

		stream_set_timeout($this->socket, static::$timeout);
		stream_set_blocking($this->socket, static::$blockingMode);
		$this->send($password, self::PACKET_TYPE_AUTH);
	}

	public function disconnect()
	{
		fclose($this->socket);
	}


	public function send($message, $type = self::PACKET_TYPE_CMD)
	{
		$id = ++$this->packetId;
		$request = pack('VV', $id, $type) . $message . "\x00\x00";
		$request = pack('V', strlen($request)) . $request;

		fwrite($this->socket, $request);
		return $id;
	}



	public function GetPlayerCount()
	{
		$pattern = "/players : [0-9]{1,} \([0-9]{2,} max\) \([0-9]{1,} queued\) \([0-9]{1,} joining\)/";
		$this->send("status");
		$start = time();
		$end = $start + 10;
		$i = 0;
		while (time() < $end)
		{
			$this->send("status");
			$response = $this->read();
			if (preg_match($pattern, $response))
			{
				return(explode(" " ,array_values(preg_grep($pattern, explode("\n", $response)))[0])[2]);
			}
			usleep(1000000); // 1000ms
		}
	}



	/**
	* @return null|string Null if no or empty response received, a string if a response was received.
	* @throws Exception when the socket terminates or something goes wrong.
	*/
	public function read()
	{
		if (feof($this->socket))
		{
			throw new Exception('Reached unexpected end of socket.');
		}


		// Let's do this
		$size = fread($this->socket, 4);
		if (strlen($size) !== 4)
		{
			return null;
		}


		$size = unpack('V', $size);
		$id = unpack('V', fread($this->socket, 4))[1];
		$type = unpack('V', fread($this->socket, 4))[1];

		$remaining = $size[1] - 8;

		$body = '';
		while ($remaining > 0)
		{
			$response = fread($this->socket, $remaining);
			$size = strlen($response);
			if ($size === 0)
			{
				throw new Exception('Received 0 byte response, expected: ' . $remaining);
			}


			$body .= $response;
			$remaining = $remaining - strlen($body);
		}


		$body = trim($body);
		if (empty($body))
		{
			return null;
		}

		if ($type === self::PACKET_TYPE_CMD_RESPONSE)
		{
			// We don't want responses as we will receive these anyway through the normal stream.
			return null;
		}


		return $body;
	}

}

function respond($str)
{
	echo date('Y-m-d H:i:s') . substr((string)microtime(), 1, 4) . ': ' . $str . PHP_EOL;
}
