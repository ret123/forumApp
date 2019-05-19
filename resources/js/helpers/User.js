import Token from './Token';
import AppStorage from './AppStorage';
class User {
    login(userdata) {
        axios.post('/api/auth/login', userdata)
        .then(resp => this.responseAfterLogin(resp))
        .catch(err => console.log(err.response.data))
    }

    responseAfterLogin(resp) {
        const acces_token = resp.data.access_token;
        const username = resp.data.user;
        if(Token.isValidToken(acces_token)) {
            AppStorage.store(acces_token,username);
        }
    }
    hasToken() {
        const stored_token = AppStorage.getToken();
        if(stored_token) {
            return Token.isValidToken(stored_token) ? true : false;
        }
        return false;
    }

    loggedIn() {
        this.hasToken();
    }
    logout() {
        AppStorage.clear();
    }
    username() {
        if(this.loggedIn) {
            return AppStorage.getUser();
        }
    }
    userId() {
        if(this.loggedIn) {
            const payload = Token.decode(AppStorage.getToken());
            return payload.sub;
        }
    }
}

export default User = new User();