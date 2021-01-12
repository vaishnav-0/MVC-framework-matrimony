class HttpClient {
    constructor(baseUrl, path, method, headers, data) {
        this.baseUrl = baseUrl;
        this.path = path;
        this.method = method;
        this.headers = headers;
        this.data = data;
    }

    request() {
        let response = new Object();
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
            body: this.data
        };
        this.url = new URL(this.path, this.baseUrl);
        console.log(this.url);
        this.Request = new Request(this.url, this.Init);
        this.init(this.Request)
            .then(data => {
                if (!data.ok) {
                    throw new Error('network issue');
                }
                return data;
            })
            .catch(error => {
                return `error ${error}`;
            });

    }

    async init(request) {
        let abort = new AbortController();
        let signal = abort.signal;
        const response = await fetch(request, { signal });
        return response;
    }
}

class XHR extends HttpClient {
    constructor() {
        this.init;
        console.log("1")
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

// export default HttpClient;