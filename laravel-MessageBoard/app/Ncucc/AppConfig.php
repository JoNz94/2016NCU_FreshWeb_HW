<?php
namespace App\Ncucc;
	class AppConfig {
		const ROLE_USER = 1;
		const ROLE_FACULTY = 2;
		const ROLE_STUDENT = 4;
		const ROLE_ALUMNI = 8;
		const ROLE_SUSPENSION = 16;
		const ROLE_ANY_STUDENT = 32;
		const ROLE_FACEBOOK = 64;
		const ROLE_SYSUSER = 128;
		const ROLE_ADMIN = 1024;
		const ROLE_DEVELOPER = 2048;

		public static $roleMap = array (
			'ROLE_USER' => AppConfig::ROLE_USER,
			'ROLE_FACULTY' => AppConfig::ROLE_FACULTY,
			'ROLE_STUDENT' => AppConfig::ROLE_STUDENT,
			'ROLE_ALUMNI' => AppConfig::ROLE_ALUMNI,
			'ROLE_SUSPENSION' => AppConfig::ROLE_SUSPENSION,
			'ROLE_FACEBOOK' => AppConfig::ROLE_FACEBOOK
		);
	}
?>
