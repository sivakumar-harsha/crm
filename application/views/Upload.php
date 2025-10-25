<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="<?= site_url() ?>assets/fe/js/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="<?= site_url() ?>assets/wpp/floating-wpp.min.css?v5">
    <script type="text/javascript" src="<?= site_url() ?>assets/wpp/floating-wpp.min.js?v5"></script>
    <title>Upload to Dropbox</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 500px;
            margin: auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        h2 {
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .submit-btn {
            width: 100%;
            padding: 10px;
            background-color: #35424a;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .submit-btn:hover {
            background-color: #2c3e50;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Upload to Dropbox</h2>
    <form id="uploadForm" action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="file">Choose file to upload:</label>
            <input type="file" name="file" id="file" required>
        </div>
        <div class="form-group">
            <input type="submit" value="Upload File" id="btn-submit" class="submit-btn">
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        // This alert will show when the document is ready
        alert("hi");

        // Handle the form submission
        $("#uploadForm").submit(function(event) {
            // Optional: prevent the default form submission for custom handling
            event.preventDefault(); 

            // Here you can add any additional validation if needed

            // Submit the form
            this.submit(); // Use 'this' to refer to the current form
        });
    });
</script>
</body>
</html>
