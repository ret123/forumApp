class Token {
    isValidToken(token) {
        const payload = this.decode(token);
        
        if(payload) {
            return payload.iss == "http://localhost:8000/api/auth/login" || "http://localhost:8000/api/auth/signup" ? true : false;
        }
        return false;
    }
    decode(token) {
        const payload = token.split('.')[1];
        if(this.isBase64(payload)) {
            return JSON.parse(atob(payload));
        }
        return false;
       
    }

    isBase64(str) {
        try {
            return btoa(atob(str)).replace(/=/g, "") == str;
        }
        catch(error) {
            return false;
        } 
    }
}

export default Token = new Token();