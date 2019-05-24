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
        
        return JSON.parse(atob(payload));
    }
}

export default Token = new Token();