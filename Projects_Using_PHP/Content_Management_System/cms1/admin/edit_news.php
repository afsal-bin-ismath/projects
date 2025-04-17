<?php
include './connect.php';

if (!isset($_GET['id'])) {
    echo "No news ID provided.";
    exit();
}

$id = $_GET['id'];

// Fetch the current news item
$query = "SELECT * FROM news WHERE id = $id";
$result = mysqli_query($con, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "News item not found.";
    exit();
}

$row = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $news_title = $_POST['news_title'];
    $news_content = $_POST['news_content'];

    $update_query = "UPDATE news SET news_title = '$news_title', news_content = '$news_content' WHERE id = $id";

    if (mysqli_query($con, $update_query)) {
        update_news($id, $news_title, $news_content);
        echo "<script>alert('News updated successfully!');</script>";
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating news: " . mysqli_error($con);
    }
}

function update_news($id, $news_title, $news_content)
{
    $doc = new DOMDocument();
    libxml_use_internal_errors(true);
    $doc->loadHTMLFile('../index.html');

    $xpath = new DOMXPath($doc);
    $target_div = $xpath->query("//*[@id='$id']")->item(0);

    if ($target_div) {
        while ($target_div->hasChildNodes()) {
            $target_div->removeChild($target_div->firstChild);
        }

        $title_element = $doc->createElement("h2", $news_title);
        $content_element = $doc->createElement("p", $news_content);
        $target_div->appendChild($title_element);
        $target_div->appendChild($content_element);

        $doc->saveHTMLFile('../index.html');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit News</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #e0eafc, #cfdef3);
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
    }

    .form-container {
      background-color: #ffffff;
      padding: 30px 40px;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 500px;
    }

    h2 {
      margin-bottom: 25px;
      text-align: center;
      color: #2c3e50;
    }

    label {
      font-weight: 600;
      display: block;
      margin-bottom: 8px;
      color: #34495e;
    }

    input[type="text"],
    textarea {
      width: 100%;
      padding: 10px 15px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 16px;
      transition: 0.3s;
    }

    input[type="text"]:focus,
    textarea:focus {
      border-color: #2980b9;
      outline: none;
    }

    input[type="submit"] {
      width: 100%;
      padding: 12px;
      background-color: #2980b9;
      color: #fff;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    input[type="submit"]:hover {
      background-color: #1f6391;
    }
  </style>
</head>
<body>

  <div class="form-container">
    <h2>Edit News</h2>
    <form method="post">
      <label for="news_title">Title:</label>
      <input type="text" id="news_title" name="news_title"
        value="<?php echo htmlspecialchars($row['news_title']); ?>" required>

      <label for="news_content">Content:</label>
      <textarea id="news_content" name="news_content" rows="5"
        required><?php echo htmlspecialchars($row['news_content']); ?></textarea>

      <input type="submit" name="update" value="Update News">
    </form>
  </div>

</body>
</html>
