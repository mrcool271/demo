<?php

class CommonMaskWords{
	
	private $cacheKey = 'common:maskwords';
	private $contents = '';
	private $contentsTable = array();
	private $maskWords = array();

	private function load() {
		$cacheTable = ''; // mc_get($this->cacheKey);
		if($cacheTable) {
			$this->contentsTable = $cacheTable;
		}else {
			$this->reload();
		}
	}

	private function reload() {
		$table = $this->getTableFromDB();
		$table = $this->serialization($table);
// 		print_r($table);
		$this->contentsTable = $table;
		// $ret = mc_set($this->cacheKey, $table, rand(3600, 7200));
	}

	private function getTableFromDB() {
		$sql = "SELECT word FROM sensitive_word";
		// $result = DBHelper::getConn()->read($sql, array());
		// Demo 敏感词列表（从DB或MC或Redis拿数据）
		$result = array(
				array('word' => '测试'),
				array('word' => '我是谁'),
				array('word' => '你是谁'),
				array('word' => '敏感词') 
		);
		return $result;
	}
	
	public function compare($string, $withMerge = TRUE) {
		$this->contents = $string;
		$this->normalizeContent();
		$this->load();
		$this->getMaskWords();
		
		if($withMerge) {
 			// $this->mergeMaskedString();
			$ret = array(
					'mergedContent' => $this->contents,
					'maskWords' => $this->maskWords 
			);
		}else {
			$ret = array(
					'maskWords' => $this->maskWords 
			);
		}
		return $ret;
	}

	private function getMaskWords() {
		$string = strtolower($this->contents);
		$length = strlen($string);
		for($i = 0; $i < $length; ++$i) {
			$ptr = 0;
			if((ord($string{$i}) & 0xf0) == 224) {
				$sword = $string{$i} . $string{$i + 1} . $string{$i + 2};
				$hash_num = self::hashChar($sword);
				$i += 2;
				$temp = -2;
			}else {
				$hash_num = self::hashChar($string{$i});
				$temp = 0;
			}
			$j = $i + 1;
			while(isset($this->contentsTable[$ptr][$hash_num])) {
				$ptr = $this->contentsTable[$ptr][$hash_num];
				if($ptr < 0) {
					$maskWord = "";
					for($k = $i + $temp; $k < $j; ++$k) {
						$maskWord .= $string{$k};
						$this->contents{$k} = "*";
					}
					$this->maskWords[] = $maskWord;
					$i = $j - 1;
					break;
				}else {
					if((ord($string{$j}) & 0xf0) == 224) {
						$sword = $string{$j} . $string{$j + 1} . $string{$j + 2};
						$hash_num = self::hashChar($sword);
						$j += 3;
					}else {
						$hash_num = self::hashChar($string{$j});
						++$j;
					}
				}
			}
		}
	}

	/**
	 * 系列化敏感词列表
	 */
	private function serialization($wordList) {
		$serialTable = array();
		$status_num = 0;
		foreach($wordList as $word) {
			$ptr = 0; // 当前状态指针：每一个词的第一个指针都是0，接下来的全局增长
			$word['word'] = trim(strtolower($word['word']));
			$length = strlen($word['word']);
			for($i = 0; $i < $length; ++$i) {
				if((ord($word['word']{$i}) & 0xf0) == 224) {
					// a chinese char contains 3 * 8bit
					$sword = $word['word']{$i} . $word['word']{$i + 1} . $word['word']{$i + 2};
					$hash_num = self::hashChar($sword);
					$i += 2;
				}else {
					// a normal char contains 1 * 8bit
					$hash_num = self::hashChar($word['word']{$i});
				}
				if(empty($serialTable[$ptr][$hash_num])) {
					// a new char has not exist in the hashtable
					if($i < $length - 1) {
						// the 1st or 2nd char in a chinese word
						++$status_num;
						$serialTable[$ptr][$hash_num] = $status_num;
						$ptr = $status_num;
					}else {
						// a normal char or the 3rd char in a chinese word
						$serialTable[$ptr][$hash_num] = -1;
					}
				}elseif($serialTable[$ptr][$hash_num] < 0) {
					// TODO now, the 'abcd' is not work is exist 'abc';
					break;
				}else {
					if($i == $length - 1) {
						$serialTable[$ptr][$hash_num] = -1;
						break;
					}
					$ptr = $serialTable[$ptr][$hash_num];
				}
			}
		}
		return $serialTable;
	}
	
	/**
	 * hash the character
	 */
	private function hashChar($word) {
		switch(strlen($word)) {
			case 1 : // UTF-8: 0xxxxxxx this is non-chinese character, just return the ascii code
				return ord($word);
				break;
			case 3 : // UTF-8:1110xxxx 10xxxxxx 10xxxxxx if chinese character, the hash = ((first bit)-224)*64*64+((second bit)-128)*64+(third bit)
				$ret = ((ord($word{0}) & 0x1f) << 12) + ((ord($word{1}) & 0x7f) << 6) + (ord($word{2}) & 0x7f);
				return $ret;
		}
	}

	private function mergeMaskedString() {
		$this->contents = preg_replace("/\*+/", "", $this->contents);
	}

	private function normalizeContent() {
		$this->contents = preg_replace('/[^0-9a-zA-Z\x{4e00}-\x{9fff}]+/u', '', $this->contents);
	}

}

$string = "测试kkkk";
$app = new CommonMaskWords();
var_dump($app->compare($string));
