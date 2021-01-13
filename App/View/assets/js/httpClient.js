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
                    return data.json();
                }).then((data) => {
                    return data;
                })
                .catch(error => {
                    return `error ${error}`;
                });

        } else {
            response = await this.xhr().then((data) => {
                return JSON.parse(data);
            }).catch(error => {
                return `error ${error}`;
            });
        }
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
            let data = this.data.toString();
            let method = this.method;
            let headers = this.headers;
            let url = new URL(this.path, this.baseUrl);
            let Req = new XMLHttpRequest();
            Req.addEventListener('progress', (e) => {
                console.log(`${e.type}: ${e.loaded} bytes transferred`);
            });
            return new Promise(function(resolve, reject) {


                Req.open(method, url, true);
                Req.setRequestHeader('Content-type', 'application/x-www-form-urlencoded;charset=UTF-8');
                Req.send(data);
                Req.onreadystatechange = function() {
                    if (this.readyState === 4 && this.status === 200) {
                        resolve(this.responseText);
                    }
                }
            });
        } catch (e) {
            console.log(`error: ${e}`);
            return new Error("something weird happend");
        }
    }
}