<?php
use Bowling\Bowling;
use PHPUnit\Framework\TestCase;


class BowlingTest extends TestCase {
  private $game;

  protected function setUp(): void {
    $this->game = new Bowling("TestToken");
  }

  public function pointsAndScoresProvider() {
    return [
      //0 points & 0 scores
      [[[0, 0]],
      [0]],

      //1 miss
      [[[1, 1]],
      [2]],

      //1 strike & 1 miss
      [[[10, 0], [5, 3]],
      [18, 26]],

      //1 spare & 1 miss
      [[[0, 10], [5, 3]],
      [15, 23]],

      //1 strike & 1 spare
      [[[10, 0], [7, 3]],
      [20, 30]],

      //2 strikes, 3 spares & 6 misses
      [[[3, 5], [3, 5], [5, 2], [2, 6], [6, 4], [4, 6], [9, 0], [10, 0], [10, 0], [8, 2], [1, 0]],
      [8, 16, 23, 31, 45, 64, 73, 101, 121, 132]],

      //All possible strikes
      [[[10, 0], [10, 0], [10, 0], [10, 0], [10, 0], [10, 0], [10, 0], [10, 0], [10, 0], [10, 0], [10, 10]],
      [30, 60, 90, 120, 150, 180, 210, 240, 270, 300]],

      //All possible strikes
      [[[5, 5], [5, 5], [5, 5], [5, 5], [5, 5], [5, 5], [5, 5], [5, 5], [5, 5], [5, 5], [9]],
      [15, 30, 45, 60, 75, 90, 105, 120, 135, 154]],
    ];
  }

  /**
  * @dataProvider pointsAndScoresProvider
  */
  public function testTheReturnedValueOfGetPointsShouldBeSameAsTheSetPoints($points) {
    $this->game->setPoints($points);
    $this->assertSame($this->game->getPoints(), $points);
  }

  /**
  * @dataProvider pointsAndScoresProvider
  */
  public function testTheReturnedValueOfGetScoresShouldBeSameAsTheCalculatedScores($points, $scores) {
    $this->game->setScores($points);
    $this->assertSame($this->game->getScores(), $scores);
  }

  /**
  * @dataProvider pointsAndScoresProvider
  */
  public function testGetTotalScores($points, $scores) {
    $this->game->setTotalScores($scores);
    $this->assertEquals($this->game->getTotalScores(), end($scores));
  }
}
