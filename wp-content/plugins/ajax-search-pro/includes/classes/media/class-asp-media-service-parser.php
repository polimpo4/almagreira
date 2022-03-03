<?php
/* Prevent direct access */
defined('ABSPATH') or die("You can't access this file directly.");

if ( !class_exists('ASP_Media_Service_Parser') ) {
	class ASP_Media_Service_Parser {
		private $server = "https://mediaservices.ajaxsearchpro.com/";
		private $filepath, $license, $file_url, $send_file, $stats = false;

		function __construct( $filepath, $file_url, $license, $send_file = false ) {
			$this->filepath = $filepath;
			$this->file_url = $file_url;
			$this->license = $license;
			$this->send_file = $send_file;
		}

		function request() {
			$url = $this->getServer();
			if ( $this->getServer() !== false ) {
				$response = $this->post( $url );
				if ( is_wp_error($response) ) {
					return $response;
				}
				$data = json_decode($response['body'], true);
				$this->stats = $data['stats'];
				if ( $data['success'] == 0 ) {
					return new WP_Error($data['code'], $data['text']);
				} else {
					return $data['text'];
				}
			}
		}

		function getStats() {
			return $this->stats;
		}

		private function post( $url ) {
			if ( $this->send_file ) {
				$file = fopen( $this->filepath, 'r' );
				if ( false === $file ) {
					$response = new WP_Error( 'fopen', 'Could not open the file for reading.' );
				} else {
					$file_size = filesize( $this->filepath );
					$file_data = fread( $file, $file_size );
					$response = wp_safe_remote_post(
						$url,
						array_merge(
							$this->multipartPostData($file_data, $this->filepath, array(
								'license' => $this->license
							)), array(
								'timeout' => 30
							)
						)
					);
				}
			} else {
				$response = wp_safe_remote_post(
					$url,
					array(
						'body' => array(
							'license' => $this->license,
							'url' => $this->file_url
						)
					)
				);
			}

			return $response;
		}

		private function getServer() {
			$address = get_transient('_asp_media_server_address');
			if ( $address === false ) {
				$server = wp_remote_get($this->server);
				if ( !is_wp_error($server) ) {
					$address = trim($server['body']);
					set_transient('_asp_media_server_address', $address);
				} else {
					$address = false;
				}
			}

			return $address;
		}
		private function multipartPostData($file_contents, $file_name, $post_fields = array()) {
			$boundary = wp_generate_password( 24 );
			$headers  = array(
				'content-type' => 'multipart/form-data; boundary=' . $boundary,
			);
			$payload = '';

			foreach ( $post_fields as $name => $value ) {
				$payload .= '--' . $boundary;
				$payload .= "\r\n";
				$payload .= 'Content-Disposition: form-data; name="' . $name .
					'"' . "\r\n\r\n";
				$payload .= $value;
				$payload .= "\r\n";
			}

			if ( strlen($file_contents) > 0 ) {
				$payload .= '--' . $boundary;
				$payload .= "\r\n";
				$payload .= 'Content-Disposition: form-data; name="' . 'file' .
					'"; filename="' . basename( $file_name ) . '"' . "\r\n";
				$payload .= "\r\n";
				$payload .= $file_contents;
				$payload .= "\r\n";
			}
			$payload .= '--' . $boundary . '--';
			return array(
				'headers'    => $headers,
				'body'       => $payload,
			);
		}
	}
}