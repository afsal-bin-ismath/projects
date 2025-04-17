<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f2f5f9;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 40px;
        }

        input[type="text"],
        textarea {
            padding: 12px 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            resize: vertical;
        }

        button {
            padding: 12px;
            border: none;
            background: #2980b9;
            color: white;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #1f6391;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background-color: #3498db;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e0f2ff;
        }

        a {
            text-decoration: none;
            color: #2980b9;
            font-weight: 600;
        }

        a:hover {
            color: #1f6391;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            table, thead, tbody, th, td, tr {
                display: block;
            }

            th {
                display: none;
            }

            td {
                position: relative;
                padding-left: 50%;
                margin-bottom: 10px;
                border: none;
            }

            td:before {
                position: absolute;
                top: 12px;
                left: 15px;
                font-weight: bold;
                color: #333;
                white-space: nowrap;
            }

            td:nth-of-type(1):before { content: "News Title"; }
            td:nth-of-type(2):before { content: "News Content"; }
            td:nth-of-type(3):before { content: "Actions"; }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Admin Dashboard</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="text" name="news_title" placeholder="News Title" required>
            <textarea name="news_content" placeholder="CONTENT" rows="4" required></textarea>
            <button type="submit" name="submit">Add</button>
        </form>

        <?php
        include './connect.php';

        // Delete logic
        if (isset($_GET['delete_id'])) {
            $delete_id = $_GET['delete_id'];
            $delete_query = "DELETE FROM news WHERE id = $delete_id";
            mysqli_query($con, $delete_query);
            delete_news_from_html($delete_id);
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }

        $query = "SELECT * FROM news";
        if ($res = mysqli_query($con, $query)) {
            if (mysqli_num_rows($res) > 0) {
                echo "<table>";
                echo "<thead><tr>";
                echo "<th>News Title</th>";
                echo "<th>News Content</th>";
                echo "<th>Actions</th>";
                echo "</tr></thead><tbody>";
                while ($row = mysqli_fetch_assoc($res)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['news_title']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['news_content']) . "</td>";
                    echo "<td>
                        <a href='?delete_id=" . $row['id'] . "' onclick=\"return confirm('Are you sure you want to delete this news item?');\">Delete</a>
                        |
                        <a href='edit_news.php?id=" . $row['id'] . "'>Edit</a>
                    </td>";
                    echo "</tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<p>No news found.</p>";
            }
        }

        if (isset($_POST['submit'])) {
            $news_title = $_POST['news_title'];
            $news_content = $_POST['news_content'];
            $query = "INSERT INTO news (news_title, news_content) VALUES ('$news_title','$news_content')";
            if (mysqli_query($con, $query)) {
                append_news();
                echo "<script>alert('News Added!');</script>";
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            }
        }

        function append_news()
        {
            include './connect.php';
            $news_title = $_POST['news_title'];
            $news_content = $_POST['news_content'];
            $query = "SELECT max(id) as max_id FROM news";
            if ($res = mysqli_query($con, $query)) {
                $row = mysqli_fetch_assoc($res);
                $max_id = $row['max_id'];
            }
            $news_html = "<div id='$max_id'>
                            <h2>$news_title</h2>
                            <p>$news_content</p>
                          </div>";

            $doc = new DOMDocument();
            libxml_use_internal_errors(true);
            $doc->loadHTMLFile('../index.html');

            $xpath = new DOMXPath($doc);
            $div = $xpath->query('//*[@id="content"]')->item(0);

            if ($div) {
                $fragment = $doc->createDocumentFragment();
                $fragment->appendXML($news_html);
                $div->appendChild($fragment);

                $doc->saveHTMLFile('../index.html');
            }
        }

        function delete_news_from_html($id)
        {
            $doc = new DOMDocument();
            libxml_use_internal_errors(true);
            $doc->loadHTMLFile('../index.html');

            $xpath = new DOMXPath($doc);
            $target_div = $xpath->query("//*[@id='$id']")->item(0);

            if ($target_div) {
                $target_div->parentNode->removeChild($target_div);
                $doc->saveHTMLFile('../index.html');
            }
        }
        ?>
    </div>
</body>

</html>
