<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Data Fetch</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="/assets/css/styles.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Fetch Data from API</h1>
        <button id="fetchDataBtn" class="btn btn-primary mb-4">Fetch Data</button>
        <div id="dataContainer" class="d-flex flex-wrap">
           
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#fetchDataBtn').click(function() {
                $.ajax({
                    url: 'fetch_data.php',
                    method: 'GET',
                    success: function(data) {
                        const items = JSON.parse(data);
                        let content = '';
                        items.forEach(item => {
                            content += `
                                <div class="card m-2" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title">${item.title}</h5>
                                        <p class="card-text">${item.description}</p>
                                        <p class="card-text"><strong>Price:</strong> $${item.price}</p>
                                    </div>
                                </div>
                            `;
                        });
                        $('#dataContainer').html(content);
                    },
                    error: function(error) {
                        console.error('Error fetching data:', error);
                    }
                });
            });
        });
    </script>
</body>
</html>
