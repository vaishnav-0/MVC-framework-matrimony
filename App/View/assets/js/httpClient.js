class HttpClient {
    constructor(baseUrl, path, method, headers, data) {
        this.baseUrl = baseUrl;
        this.path = path;
        this.method = method;
        this.headers = headers;
        this.data = data;
    }

    request() {
        var response = new Object();
        if (window.fetch) {
            response = new Fetch(this.baseUrl, this.path, this.method, this.headers, this.data);
        } else {
            response = new XHR();
        }
        return response;
    }
}

class Fetch extends HttpClient {
    constructor(baseUrl, path, method, headers, data) {
        super(baseUrl, path, method, headers, data);
        this.Init = {
            method: this.method,
        };
        this.url = new URL(this.path, this.baseUrl);
        this.Request = new Request(this.url, this.Init);

    }

    async init() {
        let abort = new AbortController();
        let signal = abort.signal;
        const response = await fetch(this.Request);
        return response;
    }
}

class XHR extends HttpClient {
    constructor() {
        this.init;
    }

    async init() {
        try {
            Req = new XMLHttpRequest();
            let data = JSON.stringify(this.data);
            let method = this.method;
            let headers = this.headers;
            let url = this.baseUrl + this.path;
            Req.open(method, url, data, true);
            Req.send();
            Req.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    return this.responseText;
                } else
                    return new Error("something weird happend");
            }
        } catch (e) {
            console.log(`error: ${e}`);
            return new Error("something weird happend");
        }
    }
}