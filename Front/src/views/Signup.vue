<template>
    <ion-page>
        <ion-header>
            <ion-toolbar>
                <ion-buttons slot="start">
                    <ion-back-button defaultHref="/"></ion-back-button>
                </ion-buttons>
                <ion-title>Inscription</ion-title>
            </ion-toolbar>
        </ion-header>

        <ion-content class="ion-padding">
            <div class="form-container">
                <h1 class="title">Inscrivez-vous</h1>
                <form @submit.prevent="submitForm">
                    <ion-item>
                        <ion-label position="stacked">Nom</ion-label>
                        <ion-input
                            v-model="form.name"
                            placeholder="Entrez votre Nom"
                        ></ion-input>
                    </ion-item>
                    <ion-item>
                        <ion-label position="stacked">Email</ion-label>
                        <ion-input
                            type="email"
                            v-model="form.email"
                            placeholder="Entrez votre adresse email"
                        ></ion-input>
                    </ion-item>
                    <ion-item>
                        <ion-label position="stacked">Mot de passe</ion-label>
                        <ion-input
                            type="password"
                            v-model="form.password"
                            placeholder="Entrez votre Mot de passe"
                        ></ion-input>
                    </ion-item>
                    <ion-item>
                        <ion-label position="stacked">
                            Confirmez le mot de passe
                        </ion-label>
                        <ion-input
                            type="password"
                            v-model="form.password_confirmation"
                            placeholder="Confirmez votre Mot de passe"
                        ></ion-input>
                    </ion-item>
                    <ion-button
                        expand="full"
                        type="submit"
                        class="custom-button ion-margin-top"
                    >
                        S'inscrire
                    </ion-button>
                    <ion-text class="sign-up">
                        Déjà inscrit ?
                        <router-link to="/login">
                            Connectez-vous ici !
                        </router-link>
                    </ion-text>
                </form>
            </div>
        </ion-content>
    </ion-page>
</template>

<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import { useVuelidate } from "@vuelidate/core";
import { required, email, minLength } from "@vuelidate/validators";
import axios from "axios";
import { useAuthStore } from "@/stores/auth";
import {
    IonPage,
    IonHeader,
    IonToolbar,
    IonTitle,
    IonContent,
    IonItem,
    IonLabel,
    IonInput,
    IonButton,
    IonText,
    IonBackButton,
    IonButtons,
} from "@ionic/vue";

const form = ref({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const sameAsPassword = (value) => value === form.value.password;

const rules = {
    name: { required },
    email: { required, email },
    password: { required, minLength: minLength(8) },
    password_confirmation: { required, sameAsPassword },
};

const v$ = useVuelidate(rules, form);
const router = useRouter();
const authStore = useAuthStore();

const submitForm = async () => {
    v$.value.$touch();
    if (v$.value.$invalid) {
        alert("Veuillez remplir correctement tous les champs du formulaire.");
        return;
    }

    try {
        const response = await axios.post(
            "http://127.0.0.1:8000/api/register",
            form.value
        );
        localStorage.setItem("token", response.data.token);
        await authStore.fetchUser(); // Met à jour l'état global après l'inscription
        alert("Inscription réussie");
        router.push("/account");
    } catch (error) {
        console.error("Error: ", error);
        if (error.response && error.response.data.errors) {
            alert(
                "Erreur lors de l'inscription: " +
                    JSON.stringify(error.response.data.errors)
            );
        } else {
            alert("Erreur lors de l'inscription");
        }
    }
};
</script>

<style scoped>
:root {
    --background-light: #e0f7fa;
    --background-dark: #1e1e1e;
    --text-color-light: #000000;
    --text-color-dark: #ffffff;
    --button-background: #15854b;
    --button-hover: #0f6d3b;
    --text-link: #15854b;
    --border-light: #cccccc;
    --border-dark: #444444;
}

@media (prefers-color-scheme: dark) {
    :root {
        --background-light: var(--background-dark);
        --text-color-light: var(--text-color-dark);
        --border-light: var(--border-dark);
    }
}

.form-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
    background: var(--background-light);
    color: var(--text-color-light);
    border: 1px solid var(--border-light);
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    margin: auto;
    margin-top: 50px;
}

.title {
    margin-bottom: 20px;
    font-size: 24px;
    font-weight: bold;
}

.custom-button {
    --background: #15854b;
    --border-radius: 20px;
    --color: #ffffff;
    --padding-start: 20px;
    --padding-end: 20px;
    --transition: background-color 0.3s ease, color 0.3s ease;
}

.custom-button:hover {
    --background: var(--button-hover);
}

.forgot-password,
.sign-up {
    display: block;
    text-align: center;
    margin-top: 10px;
}

.forgot-password a,
.sign-up a {
    color:  #00f576;
    text-decoration: none;
    font-weight: bold;
}

.forgot-password a:hover,
.sign-up a:hover {
    text-decoration: underline;
}
</style>
