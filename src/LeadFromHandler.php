<?php


namespace LeadFromProvider;


use Throwable;

/**
 * Class LeadFromHandler
 *
 * @author artyomnar94@gmail.com
 * @version 1.0
 * @licence MIT
 */
class LeadFromHandler
{
	/**
	 * Sends simple lead form data to telegram channel or group.
	 *
	 * @param array $leadFormData
	 * @param bool $isProdEnv - whether production server environment. Usually constant value or config parameter.
	 * Example for YII2 framework YII_ENV_PROD constant value equals true if web app initialized in 'prod' environment.
	 * @param string $botToken - your telegram bot token which sends lead form into channel or group
	 * @param string $chatId - unique identifier for the target chat or username of the target channel
	 * (in the format @channelusername)
	 * @return bool
	 */
	public static function send(array $leadFormData, bool $isProdEnv, string $botToken, string $chatId): bool
	{
		if (!$isProdEnv) {
			return true;
		}

		try {
			$requestParams = [
				'chat_id' => $chatId,
				'text' => self::getMessageView($leadFormData),
				'parse_mode' => 'HTML'
			];
			$requestString = http_build_query($requestParams);
			file_get_contents("https://api.telegram.org/bot$botToken/sendMessage?" . $requestString);
			return  true;
		} catch (Throwable $exception) {
			return false;
		}
	}

	/**
	 * Generates html based message for telegram channel or group
	 *
	 * @param array $leadFormData
	 * @return string
	 */
	private static function getMessageView(array $leadFormData): string
	{
		$message = '';
		foreach ($leadFormData as $key => $value) {
			$message .= "<b>$key:</b><i>$value</i>";
		}
		return $message;
	}
}
