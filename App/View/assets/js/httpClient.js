class HttpClient {
    constructor(baseUrl, path, method, headers, data) {
        this.baseUrl = baseUrl;
        this.path = path;
        this.method = method;
        this.headers = headers;
        this.data = data;
    }

    async request() {
        let response;
        if (window.fetch) {
            let url = new URL(this.path, this.baseUrl);

            let data = {
                method: this.method,
                body: this.data
            };

            let Req = new Request(url, data);
            response = await this.fetch(Req)
                .then(data => {
                    if (!data.ok) {
                        throw new Error('network issue');
                    }
                    data.json().then((data) => {
                        console.log(data);
                        return data;
                    });
                })
                .catch(error => {
                    return `error ${error}`;
                });

        } else {
            response = xhr();
        }
        console.log(response);
        return response;
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