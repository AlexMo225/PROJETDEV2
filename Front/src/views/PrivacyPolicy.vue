<template>
    <ion-page>
        <ion-header>
            <ion-toolbar>
                <ion-buttons slot="start">
                    <ion-back-button defaultHref="/"></ion-back-button>
                </ion-buttons>
                <ion-title>Politique de Confidentialité</ion-title>
            </ion-toolbar>
        </ion-header>

        <ion-content class="ion-padding">
            <ion-card>
                <ion-card-header>
                    <ion-card-title
                        >Politique de Confidentialité</ion-card-title
                    >
                </ion-card-header>
                <ion-card-content>
                    <p>
                        Votre confidentialité est importante pour nous. Cette
                        politique décrit comment nous collectons, utilisons et
                        protégeons vos informations personnelles.
                    </p>
                    <p>
                        <strong>1. Collecte des informations :</strong><br />
                        Nous collectons des informations lorsque vous vous
                        inscrivez sur notre site, passez une commande, vous
                        abonnez à notre newsletter, etc.
                    </p>
                    <p>
                        <strong>2. Utilisation des informations :</strong><br />
                        Toute information que nous collectons auprès de vous
                        peut être utilisée pour personnaliser votre expérience,
                        améliorer notre site web, améliorer le service client,
                        etc.
                    </p>
                    <!-- Ajoutez d'autres sections de politique de confidentialité selon vos besoins -->
                </ion-card-content>
            </ion-card>
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
    IonButtons,
    IonBackButton,
} from "@ionic/vue";
</script>

<style scoped>
ion-card {
    --background: #f8f9fa;
    margin: 16px;
}

ion-card-title {
    font-size: 1.5em;
    color: #495057;
}

ion-card-content p {
    font-size: 1em;
    color: #6c757d;
    margin-bottom: 1.5em;
}
</style>
