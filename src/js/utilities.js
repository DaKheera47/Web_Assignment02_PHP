function round(x) {
    return Math.round(x * 100) / 100;
}

// https://stackoverflow.com/a/60350642
async function doAjax(url, params = {}, method = "POST") {
    return $.ajax({
        url: url,
        type: method,
        dataType: "json",
        data: params,
    });
}

async function isLoggedIn() {
    try {
        const isLoggedIn = await doAjax(
            "/~ssarfaraz/src/actions/confirmLoginStatus.php"
        );

        if (!isLoggedIn) {
            alert("You must be logged in to perform this action.");
            return false;
        }

        return true;
    } catch (error) {
        console.error("Something went wrong:", error);
        alert("Something went wrong:", error);
        return false;
    }
}
