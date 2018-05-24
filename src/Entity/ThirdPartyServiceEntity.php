<?php

class ThirdPartyServiceEntity extends \Entity implements \Drupal\blizz_vanisher\Entity\ThirdPartyServiceEntityInterface {

  /**
   * {@inheritdoc}
   */
  public function isEnabled() {
    return $this->enabled;
  }

  /**
   * {@inheritdoc}
   */
  public function getVanisher() {
    return $this->vanisher;
  }

  public function getId() {
    return $this->id;
  }

  public function isNew() {
    return $this->id;
  }
  public function getName(){
    return $this->name;
  }

  public function getInfo(){
    return $this->info;
  }

  public function getLabel() {
    return $this->label();
  }
}
