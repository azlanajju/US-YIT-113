document.addEventListener('DOMContentLoaded', function () {
    // Initial load: Display all members
    displayAllMembers();

    // Button click event for Load Premium
    document.getElementById('loadPremium').addEventListener('click', function () {
        displayPremiumMembers();
    });

    // Button click event for Load Normal
    document.getElementById('loadNormal').addEventListener('click', function () {
        displayAllMembers();
    });

    function displayAllMembers() {
        // Show all rows
        var rows = document.querySelectorAll('#membersTable tbody tr');
        rows.forEach(function (row) {
            row.style.display = '';
        });
    }

    function displayPremiumMembers() {
        // Hide non-premium rows
        var rows = document.querySelectorAll('#membersTable tbody tr');
        rows.forEach(function (row) {
            var isPremium = row.querySelector(':nth-child(4)').innerText.trim() === 'Premium';
            row.style.display = isPremium ? '' : 'none';
        });
    }
});
