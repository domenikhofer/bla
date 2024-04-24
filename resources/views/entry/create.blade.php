<!DOCTYPE html>
<html>
<head>
    <title>Entry Search</title>
</head>
<body>
    <h1>Entry Search</h1>
    <input type="text" id="entry-search" name="entry-search" placeholder="Search for entries..." />
    <div id="results"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const entrySearch = document.getElementById('entry-search');
            const resultsDiv = document.getElementById('results');

            entrySearch.addEventListener('keyup', function () {
                const searchTerm = this.value;
                if (searchTerm.length >= 3) {
                    fetch('/better-list-app/public/api/entry/search?query=' + searchTerm)
                        .then(response => response.json())
                        .then(data => {
                            let result = '';
                            resultsDiv.innerHTML = '';
                            if (data.length) {
                                data.forEach(function (entry) {
                                    result += `<div>${entry.value}</div>`;
                                });
                                resultsDiv.innerHTML = result;
                            }
                        })
                        .catch(error => console.error('Error:', error));
                } else {
                    resultsDiv.innerHTML = '';
                }
            });
        });
    </script>
</body>
</html>
