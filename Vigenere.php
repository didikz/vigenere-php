<?php

/**
 *  Vigenere encryption algorithm
 *
 *  Author: Didik Tri Susanto
 *  Email : didiktrisusanto@yahoo.com
 *  
 */
class Vigenere {

	/**
	 * Key attribute
	 * 
	 * @var String
	 */
	private $key;

	/**
	 * Characters collection
	 * 
	 * @var array
	 */
	private $chars = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');

	/**
	 * Build key in constructor
	 * 
	 * @param String $key encryption key
	 */
	public function __construct($key)
	{
		if (isset($key)) {
			$this->key = str_split($key);
		} else {
			$this->key = str_split("holaholo");
		}
		
	} 

	/**
	 * Encryption formula
	 * E = (p + k) mod 26
	 * 
	 * @param  Integer $k index of key text
	 * @param  Integer $p index of plain text
	 * @return Integer
	 */
	private function encryptFormula($p, $k)
	{
		$mod = gmp_mod(($p + $k), 26);
		return gmp_strval($mod);
	}

	/**
	 * Encryption formula
	 * D = (p -k) mod 26
	 * 
	 * @param  Integer $k index of key text
	 * @param  Integer $p index of plain text
	 * @return Integer
	 */
	private function decryptFormula($p, $k)
	{
		$mod = gmp_mod(($p - $k), 26);
		return gmp_strval($mod);
	}

	/**
	 * Encryption or decryption process
	 * 
	 * @param  String $plaintext plain text
	 * @param  Bool is decrypt
	 * @return String
	 */
	public function vigenere($plaintext, $decrypt = false)
	{
		$keyArray = array();
		$index    = 0;
		$result   = '';

		// normalization, change to lowercase and remove blank space
		$lower   = strtolower($plaintext);
		$trimmed = str_replace(" ", "", $lower);
		$toArray = str_split($trimmed);

		// build key array
		for ($i=0; $i < count($toArray); $i++) { 
			if($index == count($this->key)) {
				$index = 0;
			}
			$keyArray[] = $this->key[$index];
			$index++;
		}
		
		// calculate encryption or decryption
		for ($i=0; $i < count($toArray); $i++) { 
			$p = array_search($toArray[$i], $this->chars);
			$k = array_search($keyArray[$i], $this->chars);

			if($decrypt) {
				$vigValue = $this->encryptFormula($p, $k);
			} else {
				$vigValue = $this->decryptFormula($p, $k);
			}
			
			$result .= $this->chars[$vigValue];
		}

		return $result;
	}	

}
