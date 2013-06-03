<?php
class Minter {
  private $config = array();

  function __construct($config_file) {
    $this->config = parse_ini_file($config_file);
    $this->ch = curl_init();
    curl_setopt_array($this->ch, $this->options());
  }

  public function mint() {
    return $this->match_identifier(curl_exec($this->ch));
  }

  private function match_identifier($string) {
    $identifier = 'undefined';
    if (preg_match('/id:\s+(\S+)/', $string, $matches)) {
      $identifier = $matches[1];
    }

    return $identifier;
  }

  private function options() {
    return array(
      CURLOPT_URL => $this->config['host'],
      CURLOPT_HEADER => FALSE,
      CURLOPT_POST => TRUE,
      CURLOPT_POSTFIELDS => $this->query(),
      CURLOPT_RETURNTRANSFER => TRUE,
    );
  }

  private function query() {
    return 'shoulder=' . $this->config['shoulder'];
  }
}
?>
