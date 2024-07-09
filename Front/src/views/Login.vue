<template>
    <ion-page>
        <ion-header>
            <ion-toolbar>
                <ion-buttons slot="start">
                    <ion-back-button defaultHref="/"></ion-back-button>
                </ion-buttons>
                <ion-title>Connexion</ion-title>
            </ion-toolbar>
        </ion-header>

        <ion-content class="ion-padding">
            <div class="form-container">
                <h1 class="title">Connectez-vous</h1>
                <div class="logo">
                    <img src="/img/images.png" alt="Webstart Cloud Logo" />
                </div>
                <form @submit.prevent="submitForm">
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
                            placeholder="Entrez votre mot de passe"
                        ></ion-input>
                    </ion-item>
                    <ion-button
                        expand="full"
                        type="submit"
                        class="custom-button ion-margin-top"
                        >CONNEXION</ion-button
                    >
                    <ion-text class="forgot-password">
                        <a href="#" @click.prevent="forgotPassword"
                            >Mot de passe oublié ?</a
                        >
                    </ion-text>

                    <ion-text class="sign-up">
                        Pas encore inscrit ?
                        <router-link to="/signup"
                            >Inscrivez-vous ici !</router-link
                        >
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
    IonBackButton,
    IonButtons,
    IonText,
} from "@ionic/vue";

const form = ref({
    email: "",
    password: "",
});

const rules = {
    email: { required, email },
    password: { required, minLength: minLength(6) },
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

    const success = await authStore.login(form.value);
    if (success) {
        alert("Connexion réussie");
        router.push("/account");
    } else {
        alert("Erreur lors de la connexion");
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
}

@media (prefers-color-scheme: dark) {
    :root {
        --background-light: var(--background-dark);
        --text-color-light: var(--text-color-dark);
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

.logo {
    margin-bottom: 20px;
}

.title {
    margin-bottom: 20px;
    font-size: 24px;
    font-weight: bold;
}

.logo img {
    width: 150px;
}

.custom-button {
    --background:#15854b;
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
    color: var(--text-link);
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
