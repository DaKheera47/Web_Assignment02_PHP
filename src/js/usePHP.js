
// https://stackoverflow.com/a/406338
function usePHP(params, url) {
    // return a new promise, so that the caller can handle the response asychronously
    return new Promise(function (resolve, reject) {
        let httpc = new XMLHttpRequest(); // simplified for clarity
        httpc.open("POST", url, true); // sending as POST
        httpc.setRequestHeader(
            "Content-Type",
            "application/x-www-form-urlencoded"
        );
        let output = null;

        httpc.onreadystatechange = function () {
            // Call a function when the state changes.
            if (httpc.readyState == 4) {
                if (httpc.status == 200) {
                    // complete and no errors
                    output = httpc.responseText;
                    resolve(output);
                } else {
                    reject(new Error(httpc.statusText));
                }
            }
        };

        httpc.onerror = function () {
            reject(new Error("Network error"));
        };

        httpc.send(params);
    });
}
