<template>
    <ion-page>
        <ion-header>
            <ion-toolbar>
                <ion-buttons slot="start">
                    <ion-back-button defaultHref="/"></ion-back-button>
                </ion-buttons>
                <ion-title>Contact</ion-title>
            </ion-toolbar>
        </ion-header>

        <ion-content class="ion-padding">
            <div class="contact-container">
                <h1 class="title">CONTACTEZ-NOUS</h1>
                <div class="contact-card">
                    <form @submit.prevent="submitForm">
                        <ion-item>
                            <ion-label position="stacked">Nom et Prénom</ion-label>
                            <ion-input
                                v-model="form.name"
                                placeholder="Entrez votre nom et prénom"
                            ></ion-input>
                        </ion-item>
                        <ion-item>
                            <ion-label position="stacked">Email</ion-label>
                            <ion-input
                                type="email"
                                v-model="form.email"
                                placeholder="Entrez votre email"
                            ></ion-input>
                        </ion-item>
                        <ion-item>
                            <ion-label position="stacked">Objet</ion-label>
                            <ion-input
                                v-model="form.subject"
                                placeholder="Entrez l'objet de votre message"
                            ></ion-input>
                        </ion-item>
                        <ion-item>
                            <ion-label position="stacked">Message</ion-label>
                            <ion-textarea
                                v-model="form.message"
                                placeholder="Entrez votre message"
                            ></ion-textarea>
                        </ion-item>
                        <ion-button
                            expand="full"
                            type="submit"
                            class="custom-button ion-margin-top"
                        >Envoyer</ion-button>
                    </form>
                </div>

                <div class="contact-card contact-info">
                    <h3>Coordonnées</h3>
                    <p>19 rue Yves Toudic, 75010 Paris</p>
                    <p>Téléphone : 01 23 45 67 89</p>
                    <p>Email : alexmorel1999@gmail.com</p>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.890080960569!2d2.364290915673417!3d48.86970847928832!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e1c3ed7a0c5%3A0x1a2a8e9e6e09db20!2s19%20Rue%20Yves%20Toudic%2C%2075010%20Paris%2C%20France!5e0!3m2!1sen!2sus!4v1638282062582!5m2!1sen!2sus"
                        width="100%"
                        height="250"
                        style="border: 0"
                        allowfullscreen=""
                        loading="lazy"
                    ></iframe>
                </div>
            </div>
        </ion-content>
    </ion-page>
</template>

<script setup>
import { ref } from "vue";
import { useVuelidate } from "@vuelidate/core";
import { required, email, minLength } from "@vuelidate/validators";
import axios from "axios";
import {
    IonPage,
    IonHeader,
    IonToolbar,
    IonTitle,
    IonContent,
    IonItem,
    IonLabel,
    IonInput,
    IonTextarea,
    IonButton,
    IonBackButton,
    IonButtons,
} from "@ionic/vue";

const form = ref({
    name: "",
    email: "",
    subject: "",
    message: "",
});

const rules = {
    name: { required },
    email: { required, email },
    subject: { required },
    message: { required, minLength: minLength(50) },
};

const v$ = useVuelidate(rules, form);

const submitForm = async () => {
    v$.value.$touch();
    if (!v$.value.$invalid) {
        try {
            await axios.post("http://127.0.0.1:8000/api/contact", form.value);
            alert("Message envoyé avec succès");
            form.value.name = "";
            form.value.email = "";
            form.value.subject = "";
            form.value.message = "";
        } catch (error) {
            console.error(error);
            alert("Erreur lors de l'envoi du message");
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

.contact-container {
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
    text-align: center;
}

.contact-card {
    width: 100%;
    max-width: 400px;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 20px;
    background: var(--background-light);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.contact-info {
    text-align: center;
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
</style>
