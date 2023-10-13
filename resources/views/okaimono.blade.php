<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        #shopping-list {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 400px;
            margin: auto;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #ddd;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 8px;
            border-radius: 4px;
            cursor: pointer;
        }

        input {
            padding: 6px;
            width: 70%;
        }

        #copy-button {
            background-color: #2196F3;
        }
    </style>
</head>
<body>

    <div id="shopping-list">
        <h2 id="list-title">My Shopping List</h2>
        <label for="list-name">List Name:</label>
        <input type="text" id="list-name" placeholder="Enter list name">
        <button onclick="changeListName()">Change Name</button>
        <ul id="list">
            <!-- Existing items will go here -->
        </ul>
        <div>
            <input type="text" id="item" placeholder="Add an item">
            <button onclick="addItem()">Add</button>
        </div>
        <button onclick="saveList()">Save List</button>
        <button onclick="shareList()">Share List</button>
        <button id="copy-button" onclick="copyLink()">Copy Link</button>
    </div>

    <script>
        // Function to get URL parameters
        function getUrlParameter(name) {
            name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
            var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
            var results = regex.exec(location.search);
            return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
        }

        function changeListName() {
            var listNameInput = document.getElementById("list-name");
            var listTitle = document.getElementById("list-title");
            listTitle.textContent = listNameInput.value || "My Shopping List";
        }

        function addItem() {
            var input = document.getElementById("item");
            var itemText = input.value;

            if (itemText.trim() === "") {
                alert("Please enter a valid item.");
                return;
            }

            var list = document.getElementById("list");
            var listItem = document.createElement("li");
            listItem.innerHTML = `
                <span>${itemText}</span>
                <button onclick="removeItem(this)">Remove</button>
            `;
            list.appendChild(listItem);

            input.value = "";
        }

        function removeItem(button) {
            var listItem = button.parentElement;
            listItem.remove();
        }

        function saveList() {
            var listName = document.getElementById("list-name").value || "MyShoppingList";
            var listContent = "";

            var listItems = document.getElementById("list").getElementsByTagName("li");
            for (var i = 0; i < listItems.length; i++) {
                var itemText = listItems[i].querySelector("span").textContent;
                listContent += itemText + "\n";
            }

            var blob = new Blob([listContent], { type: "text/plain" });
            var a = document.createElement("a");
            a.href = URL.createObjectURL(blob);
            a.download = listName + ".txt";
            a.click();
        }

        function shareList() {
            var listName = document.getElementById("list-name").value || "MyShoppingList";
            var listContent = getListContent();

            var shareLink = window.location.href.split('?')[0] + '?list=' + encodeURIComponent(listName) + '&items=' + encodeURIComponent(listContent);
            alert("Share this link:\n" + shareLink);
        }

        function copyLink() {
            var listName = encodeURIComponent(document.getElementById("list-name").value);
            var listContent = encodeURIComponent(getListContent());
            var shareLink = window.location.href.split('?')[0] + '?list=' + listName + '&items=' + listContent;
            
            navigator.clipboard.writeText(shareLink).then(function() {
                alert("Link copied to clipboard!");
            }).catch(function(err) {
                console.error('Unable to copy to clipboard', err);
            });
        }

        function getListContent() {
            var listContent = "";

            var listItems = document.getElementById("list").getElementsByTagName("li");
            for (var i = 0; i < listItems.length; i++) {
                var itemText = listItems[i].querySelector("span").textContent;
                listContent += itemText + "\n";
            }

            return listContent;
        }

        // Function to populate the list from URL parameters
        function populateListFromUrl() {
            var listName = getUrlParameter('list');
            var items = getUrlParameter('items');

            if (listName) {
                document.getElementById("list-name").value = decodeURIComponent(listName);
                changeListName();
            }

            if (items) {
                var itemList = items.split('\n');
                var list = document.getElementById("list");

                for (var i = 0; i < itemList.length; i++) {
                    var itemText = itemList[i].trim();
                    if (itemText !== "") {
                        var listItem = document.createElement("li");
                        listItem.innerHTML = `
                            <span>${itemText}</span>
                            <button onclick="removeItem(this)">Remove</button>
                        `;
                        list.appendChild(listItem);
                    }
                }
            }
        }

        // Populate the list on page load
        populateListFromUrl();
    </script>

</body>
</html>
