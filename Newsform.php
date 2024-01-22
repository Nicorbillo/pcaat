<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,minimum-scale=1">
		<title>Create News</title>
		<link href="style.css" rel="stylesheet" type="text/css">
        <style>
        html, body {
            background-color: #f9fafc;
        }
        </style>
	</head>
	<body>
	    <div class="create-news">

            <h1>Create News</h1>

            <form action="" method="post"  enctype="multipart/form-data">

                <label for="title"><span class="required">*</span>Title</label>
                <input type="text" name="title" id="title" placeholder="Title" required>

                <label for="description"><span class="required">*</span>Description</label>
                <textarea name="description" id="description" placeholder="Description" required></textarea>

                <label for="link"><span class="required">*</span>Link</label>
                <input type="url" name="link" id="link" placeholder="https://example.com/article/lorum-ipsum" required>

                <label for="img">Featured Image</label>
                <input type="file" name="img" id="img" accept="image/*">

                <label for="date"><span class="required">*</span>Publish Date</label>
                <input type="datetime-local" name="date" id="date" value="<?=date('Y-m-d H:i')?>" required>

                <?php if (isset($msg)): ?>
                <?=$msg?>
                <?php endif; ?>

                <button type="submit">Create</button>

            </form>

        </div>
	</body>
</html>