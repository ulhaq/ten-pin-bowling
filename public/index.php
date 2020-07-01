<?php
  require_once(__DIR__ . '/../vendor/autoload.php');

  $getRequest = Bowling\Request::get();

  $g = new Bowling\Bowling($getRequest->token);

  $g->setPoints($getRequest->points);
  $g->setScores($g->getPoints());
  $g->setTotalScores($g->getScores());
?>
<html>
  <head>
    <title>Bowling Game</title>
    <style>
      table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
      }
      th, td {
        padding: 15px;
      }
    </style>
  </head>
  <body>
    <p><a href="">Get results for a new game</a></p>

    <table>
      <tr>
        <th>Total Scores</th>
        <th>Total Rolls</th>
        <th>Success Status</th>
        <th>Token</th>
        <?php
          foreach($g->getPoints() as $points) {
            echo "<th>" . $points[0] . "</th>";
            echo "<th>" . $points[1] . "</th>";
          }
        ?>
      </tr>
      <tr>
        <td><?php echo $g->getTotalScores(); ?></td>
        <td><?php echo count($g->getPoints()); ?></td>
        <td><?php echo $g->postResult()->success; ?></td>
        <td><?php echo Bowling\Token::getToken(); ?></td>
        <?php
          foreach($g->getScores() as $score) {
            echo "<td colspan='2'>" . $score . "</td>";
          }
        ?>
      </tr>
    </table>
  </body>
</html>
