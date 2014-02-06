<?php 

class ram108_fbalbum_data {

	// SETTINGS
	private 
		$limit = 100,
		$random_limit = 250,
		$hidden_ratio = 3;

	// RAW DATA
	private 
		$data_url = 'https://graph.facebook.com/{ALBUM_ID}?fields=id,name,description,photos.limit({LIMIT}).fields(source,link,images,name)',
		$ttl = 3600;

	// DATA
	private 
		$args,
		$data;

	public function __construct( $args ){

		if ( !APC_AVAILABLE ) $this->random_limit = intval( $this->random_limit / 2 );

		$this->args = $args;
		$this->_clean_args();
		$this->_get_data();
	}

	private function _clean_args(){

		extract( $this->args );

		// LIMIT
		$limit = (int)$limit ? (int)$limit : $this->limit;

		// ALBUM_ID
		preg_match(	'|\?set=a\.(\d+)|i', $url, $album_id );
		$album_id = @$album_id[1];

		// REQUEST
		$request = $this->data_url;
		$request = str_replace( '{ALBUM_ID}', $album_id, $request );
		$request = str_replace( '{LIMIT}', $random ? $this->random_limit : ( @$hidden ? $limit * $this->hidden_ratio : $limit ), $request );

		// SAVE
		$this->args['limit'] = $limit;
		$this->args['data_id'] = $album_id;
		$this->args['data_url'] = $request;
	}

	private function _get_data(){

		if ( !APC_AVAILABLE || ( APC_AVAILABLE && !$this->data = @apc_fetch( $hash = 'ram108_fbalbum_'.hash( 'md5', json_encode( array( $this->args['data_url'], $this->args['size'] ) ) ) ) ) ) {

			$this->_get_raw_data(); 
			if ( @$this->data['error'] ) return;

			$this->_get_clean_data();
			if ( APC_AVAILABLE ) @apc_store( $hash, $this->data, $this->ttl );
		}

		if ( $this->args['random'] ) $this->_data_shuffle();
	}

	private function _get_raw_data() {

		extract( $this->args );

		if ( empty( $url ) ) return $this->_error('The album URL is empty');
		if ( empty( $data_id ) ) return $this->_error('The album URL is wrong');

		$data = wp_remote_get( $this->args['data_url'], array(
			'user-agent'	=> 'Mozilla/5.0 (X11; Linux x86_64; rv:25.0) Gecko/20100101 Firefox/25.0',
			'timeout' 		=> 15,
			'sslverify'		=> false,
		));
		if ( is_wp_error( $data ) ) return $this->_error('cURL error response: '.$data->get_error_message());

		$data = json_decode( @$data['body'], true );
		if ( @$data['error'] ) return $this->_error('Facebook error response: '.@$data['error']['message']);
		if ( empty( $data ) ) return $this->_error('Unexpected error: Can\'t fetch album from Facebook');

		$this->data = &$data;
	}

	private function _get_clean_data(){

		$data = array();

		// ALBUM

		$data['album'] = array(

			'id'				=> $this->data['id'],
			'url'				=> $this->args['url'],
			'name'				=> $this->_clean_str( @$this->data['name'] ),
			'description'		=> $this->_clean_str( @$this->data['description'], 0 ),
			'count'				=> count( $this->data['photos']['data'] ),
		);

		// IMAGE

		$data['image'] = array();
		$album = &$data['album'];

		foreach( $this->data['photos']['data'] as $id => $image ){

			$_image = array(
				'url'				=> $image['source'],
				'name'				=> $this->_clean_str( @$image['name'] ),
				'thumb'				=> $this->_get_thumb( $id ),
			);

			if ( $_image['name'] == '' && $album['name'] != 'Timeline Photos' ) $_image['name'] = $album['name'];

			$data['image'] []= $_image;
		}

		// RESULT

		$this->data = $data;
	}

	private function _data_shuffle(){

		shuffle( $this->data['image'] );
		$this->data['image'] = array_slice( $this->data['image'], 0, @$this->args['hidden'] ? $this->args['limit'] * $this->hidden_ratio : $this->args['limit'] );
	}

	private function _get_thumb( $id ){

		$image = $this->data['photos']['data'][$id]['images']; 
		$size = $this->args['size'];
		$count = count( $image ) - 1;

		if ( $count > 0 ) $count--; // FIX: STRANGE FACEBOOK BUG WITH WRONG W/H ON LAST IMAGE

		for( $i = $count; $i > 0; $i-- ) if ( min( $image[$i]['width'], $image[$i]['height'] ) >= $size ) break;

		return $image[$i]['source'];
	}

	private function _clean_str( $str, $len = 35 ){

		$str = strip_tags( $str );

		// remove Facebook meta data "@[165831197711:274:Morristown-Hamblen Library]"
		$str = preg_replace('|@\[.+:.+:(.+)\]|sU', '$1', $str);

		// remove #tags
		$str = preg_replace('|#[^\s]+\s*|s', '', $str);

		// trimS
		$str = trim( preg_replace('|\s{2,}|s', ' ', $str ) );

		// cut
		if ( $len ) $str = wp_trim_words( $str, $len, '...' );
		if ( mb_strlen( $str ) < 4 ) $str = '';

		return htmlspecialchars( $str );
	}

	private function _error( $text ){

		$this->data['error'] = '<p class="ram108_fbalbum_error">[ram108] '.$text.'. [<a href="'.$this->args['url'].'">check url</a>] [<a href="https://www.google.com/search?q='.urlencode($text).'">ask google</a>]</p>';
		if ( !current_user_can( 'edit_post' ) ) $this->data['error'] = '<!-- FBALBUM ERROR. LOGIN TO SEE ERROR MESSAGE -->';
	}

	// MAGIC 

	public function __get( $name ) {

		return @$this->data[ $name ];
	}
}
