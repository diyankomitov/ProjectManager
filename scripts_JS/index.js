window.onload = function () {
    refresh();
    setInterval(refresh, 5000);
};

function refresh() {
    chat_refreshPage(false, true);
    // projects_retrieveProjects()
}