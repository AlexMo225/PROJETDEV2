<template>
    <ion-page>
        <ion-header>
            <ion-toolbar>
                <ion-buttons slot="start">
                    <ion-back-button defaultHref="/"></ion-back-button>
                </ion-buttons>
                <ion-title>Paiement Annulé</ion-title>
            </ion-toolbar>
        </ion-header>

        <ion-content class="ion-padding">
            <div class="cancel-container">
                <ion-card class="cancel-card">
                    <ion-card-header>
                        <ion-card-title class="ion-text-center"
                            >Paiement Annulé</ion-card-title
                        >
                    </ion-card-header>
                    <ion-card-content>
                        <ion-text class="ion-text-center">
                            Votre paiement a été annulé. Vous pouvez réessayer
                            ou contacter notre support si vous avez des
                            questions.
                        </ion-text>
                        <ion-button
                            expand="full"
                            class="custom-button"
                            router-link="/"
                            >Retour à l'accueil</ion-button
                        >
                    </ion-card-content>
                </ion-card>
            </div>
        </ion-content>
    </ion-page>
</template>

<script setup>
import {
    IonPage,
    IonHeader,
    IonToolbar,
    IonTitle,
    IonContent,
    IonCard,
    IonCardHeader,
    IonCardTitle,
    IonCardContent,
    IonText,
    IonButton,
    IonButtons,
    IonBackButton,
} from "@ionic/vue";
</script>

<style scoped>
.cancel-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
}

.cancel-card {
    max-width: 400px;
    width: 100%;
    background: #ffffffce;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

.custom-button {
    --background: #15854b;
    --border-radius: 20px;
    --color: #ffffff;
    --padding-start: 20px;
    --padding-end: 20px;
    --transition: background-color 0.3s ease, color 0.3s ease;
    margin-top: 20px;
}

.custom-button:hover {
    --background: #0f6d3b;
}
</style>
