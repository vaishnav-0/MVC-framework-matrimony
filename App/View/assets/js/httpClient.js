class HttpClient {
    constructor(baseUrl, path, method, headers, data) {
        this.baseUrl = baseUrl;
        this.path = path;
        this.method = method;
        this.headers = headers;
        this.data = data;
    }

    request() {
        const response = new Object();
        if (window.fetch) {
            let url = new URL(this.path, this.baseUrl);

            let data = {
                method: this.method,
                headers: this.headers,
                body: this.data
            };

            let Request = new Request(url, data);

            response = this.fetch(Request)
                .then(data => {
                    if (!data.ok) {
                        throw new Error('network issue');
                    }
                    return data;
                })
                .catch(error => {
                    return `error ${error}`;
                });

        } else {
            response = xhr();
        }
        return JSON.parse(response);
    }

    async fetch(request) {
        let abort = new AbortController();
        let signal = abort.signal;
        const response = await fetch(request, { signal });
        return response;
    }

    async xhr() {
        try {
            Req = new XMLHttpRequest();
            let data = JSON.stringify(this.data);
            let method = this.method;
            let headers = this.headers;
            let url = this.baseUrl + this.path;
            Req.open(method, url, data, true);
            Req.send();
            Req.onreadystatechange = function () {
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