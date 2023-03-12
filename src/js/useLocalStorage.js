// get localStorage
const getLocalStorage = (key) => {
    let value = localStorage.getItem(key);
    if (value) {
        return JSON.parse(localStorage.getItem(key));
    } else {
        return [];
    }
};

// set localStorage
const setLocalStorage = (key, value) => {
    localStorage.setItem(key, JSON.stringify(value));
};
