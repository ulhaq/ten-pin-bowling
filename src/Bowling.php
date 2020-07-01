<?php
namespace Bowling;

class Bowling {
  private $totalScores;
  private $points = [];
  private $scores = [];

  public function __construct(?string $token) {
    Token::setToken($token);
  }

  /**
   * postResult - Send the calculated scores to the API.
   * @return object Returns an object with the success/failure details and an array consisting of the points.
   */
  public function postResult() {
    return Request::post(["token" => Token::getToken(), "points" => $this->getScores()]);
  }

  /**
   * setPoints - Assign an array to the property $points.
     * @param array $points An array consisting of the points. This will typically come from the API.
   */
  public function setPoints(array $points): void {
      $this->points = $points;
  }

  /**
   * getPoints - Get the points.
   * @return array Returns an array with the points.
   */
  public function getPoints(): array {
    return $this->points;
  }

  /**
   * setScores - Calculate the scores and assign them to the property $scores.
   * @param array $points An array consisting of the points.
   */
  public function setScores(array $points): void {
    $currentTotalScores = 0;
    $count = count($points);

    for($frame = 0; $frame < $count; $frame++) {
      if($frame < 10) {
        if($this->isStrike($points[$frame]) === true) {
          $this->scores[] = $this->strikeScores($points, $frame) + $currentTotalScores;
        }
        elseif($this->isSpare($points[$frame]) === true) {
          $this->scores[] = $this->spareScores($points, $frame) + $currentTotalScores;
        }
        else {
          $this->scores[] = $this->missScores($points[$frame]) + $currentTotalScores;
        }

        $currentTotalScores = end($this->scores);
      }
    }
  }

  /**
   * getScores - Get the scores.
   * @return array Returns an array with the scores.
   */
  public function getScores(): array {
    return $this->scores;
  }

  /**
   * setTotalScores - Assign the total scores to the property $totalScores.
   * @param array $scores An array consisting of the scores.
   */
  public function setTotalScores(array $scores): void {
      $this->totalScores = end($scores);
  }

  /**
   * getTotalScores - Get the total scores.
   * @return int Returns an integer with the total scores.
   */
  public function getTotalScores(): int {
    return $this->totalScores;
  }

  /**
   * isStrike - Check whether or not a frame is a strike.
   * @param  array  $frame The frame to check whether it is a strike or not.
   * @return boolean         Returns true if it is a strike, otherwise false.
   */
  private function isStrike(array $frame): bool {
    return ($frame[0] === 10 && $frame[1] === 0) ? true : false;
  }

  /**
   * isSpare - Check whether or not a frame is a spare.
   * @param  array  $frame The frame to check whether it is a strike or not.
   * @return boolean       Returns true if it is a strike, otherwise false.
   */
  private function isSpare(array $frame): bool {
    return (!$this->isStrike($frame) && array_sum($frame) === 10) ? true : false;
  }

  /**
   * missScores - Calculate the scores of a miss.
   * @param  array  $frame The frame of which the scores have to be calculated.
   * @return int           Returns a integer of with the scores.
   */
  private function missScores(array $frame): int {
    return array_sum($frame);
  }

  /**
   * strikeScores - Calculate the scores of a strike.
   * @param  array  $frame The frame of which the scores have to be calculated.
   * @return int           Returns an integer with the scores.
   */
  private function strikeScores(array $frames, int $currentFrame): int {
    if(isset($frames[$currentFrame+1])) {
      if($this->isStrike($frames[$currentFrame+1]) && isset($frames[$currentFrame+2])){
        return 10 + array_sum($frames[$currentFrame+1]) + $frames[$currentFrame+2][0];
      }

      return 10 + array_sum($frames[$currentFrame+1]);
    }

    return 10;
  }

  /**
   * spareScores - Calculate the scores of a spare.
   * @param  array  $frame The frame of which the scores have to be calculated.
   * @return int           Returns an integer with the scores.
   */
  private function spareScores($frames, $currentFrame): int {
    if(isset($frames[$currentFrame+1])) {
      return 10 + $frames[$currentFrame+1][0];
    }
    
    return 10;
  }
}
