import { defineStore } from "pinia";
import axios from "axios";

export const useAuthStore = defineStore("auth", {
    state: () => ({
        token: localStorage.getItem("token") || "",
        isConnected: !!localStorage.getItem("token"),
        user: null,
        isSubscribed: false,
    }),
    actions: {
        // login logique api
        async login(credentials) {
            try {
                const response = await axios.post(
                    "http://127.0.0.1:8000/api/login",
                    credentials
                );
                this.token = response.data.token;
                this.isConnected = true;
                localStorage.setItem("token", this.token);
                await this.fetchUser();
                return true;
            } catch (error) {
                console.error("Login error:", error);
                return false;
            }
        },
        // Action pour récupérer les informations de l'utilisateur connecté
        async fetchUser() {
            if (!this.token) return;
            try {
                const response = await axios.get(
                    "http://127.0.0.1:8000/api/user",
                    {
                        headers: {
                            Authorization: `Bearer ${this.token}`,
                        },
                    }
                );
                this.user = response.data;
                this.isSubscribed = !!response.data.subscription; // Suppose que l'utilisateur a une propriété "subscription"
            } catch (error) {
                console.error("Fetch user error:", error);
            }
        },
        // dconnexion
        async logout() {
            try {
                await axios.post(
                    "http://127.0.0.1:8000/api/logout",
                    {},
                    {
                        headers: {
                            Authorization: `Bearer ${this.token}`,
                        },
                    }
                );
                this.token = "";
                this.isConnected = false;
                this.user = null;
                this.isSubscribed = false;
                localStorage.removeItem("token");  // Suppression du token de localStorage
                return true;
            } catch (error) {
                console.error("Logout error:", error);
                return false;
            }
        },
    },
});
