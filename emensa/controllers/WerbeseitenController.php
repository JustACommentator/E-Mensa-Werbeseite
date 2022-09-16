<?php
//require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gericht.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../models/login.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../models/bewertung.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../models/GerichtAR.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../models/BewertungAR.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../models/WunschgerichtAR.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../models/NewsletterAR.php');

class WerbeseitenController
{
    public function home()
    {
        $highlightedReviews = BewertungAR::where('hervorgehoben', '=', 1)->DateDescending()->get();

        if (isset($_SESSION['email']))
            $email = $_SESSION['email'];
        else
            $email = "user not logged in";
        logger(3, $email);
        $mealdata = GerichtAR::NameAscending()->get();
        return view('werbeseite.werbeseiteHome', ['meal' => $mealdata, 'highlighted' => $highlightedReviews]);
    }

    public function soup()
    {
        $soup = GerichtAR::where('name', 'LIKE', '%suppe%')->NameAscending()->get();
        return view('werbeseite.werbeseiteSuppe', ['soup' => $soup]);
    }

    public function login()
    {
        $email = $_POST['email'] ?? null;
        $passwort = $_POST['passwort'] ?? null;
        $success = null;
        if (!is_null($email) and !is_null($passwort)) {
            $success = checkCredentials($email, $passwort);
        }
        if ($success === "passwort") {
            logger(2, $email);
            changefail($email);
        }
        if ($success === "success") {
            $_SESSION['login'] = true;
            $_SESSION['email'] = $email;
            changesuccess($email);
            logger(0, $_SESSION['email']);
        }
        if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
            header('Location: /');
        }
        return view('werbeseite.werbeseiteLogin', ['success' => $success]);
    }

    public function logout()
    {
        logger(1, $_SESSION['email']);
        session_unset();
        header('Location: /');
    }

    public function wunschgericht()
    {
        $vorname = $_POST['wunschgericht_vorname'] ?? null;
        $email = $_POST['wunschgericht_email'] ?? null;
        $gericht = $_POST['wunschgericht_name'] ?? null;
        $beschreibung = $_POST['wunschgericht_beschreibung'] ?? null;

        $success = false;

        if($gericht != null && $email != null && $beschreibung != null) {
            $wunschgericht= new WunschgerichtAR;
            $wunschgericht->vorname = $vorname;
            $wunschgericht->email = $email;
            $wunschgericht->gerichtname = $gericht;
            $wunschgericht->beschreibung = $beschreibung;
            $wunschgericht->hinzugefügt_am = date('Y-m-d H:i:s');
            $wunschgericht->save();

            $success = true;
        }

        return view('werbeseite.werbeseiteWunschgericht', ['success' => $success]);
    }

    public function bewerten()
    {
        if (!isset($_SESSION['login']) || $_SESSION['login'] == false) {
            header('Location: /login');
        }
        if (!isset($_GET['gerichtid']))
            header('Location: /');

        $meal = GerichtAR::find($_GET['gerichtid']);
        if (empty($meal))
            header('Location: /');

        $message = "";

        $comment = trim($_POST['kommentar'] ?? "");
        if (isset($_POST['kommentar']) && strlen($comment) < 5)
            $message = "Bitte geben Sie einen Kommentar von mindestens 5 Zeichen ab!";
        else {
            if (isset($_POST['bewertung']) && isset($meal['id'])) {
                addReview($meal['id'], $_POST['bewertung'], $comment);

                $message = "Bewertung erfolgreich aufgenommen!";
            }
        }

        return view('werbeseite.werbeseiteBewertung', ['meal' => $meal, 'message' => $message]);
    }

    public function bewertungen()
    {
        $user = null;
        if (isset($_SESSION['email']))
            $user = getUser($_SESSION['email']);
        $data = BewertungAR::take(30)->DateDescending()->get();
        $meal = GerichtAR::all();
        return view('werbeseite.werbeseiteBewertungList', ['data' => $data, 'meal' => $meal, 'user' => $user]);
    }

    public function meinebewertungen()
    {
        $user = null;
        if (isset($_SESSION['email']))
            $user = getUser($_SESSION['email']);
        else
            header('Location: /login');

        $data = BewertungAR::take(30)->DateDescending()->get();
        $meal = GerichtAR::all();
        return view('werbeseite.werbeseiteBewertungListOwn', ['data' => $data, 'meal' => $meal, 'user' => $user]);
    }

    public function deleteReview()
    {
        if (!isset($_SESSION['login']))
            header('Location: /');
        if (isset($_GET['gerichtid']) && isset($_SESSION['email'])) {
            $user = getUser($_SESSION['email']);
            $userid = $user['id'];

            BewertungAR::where('benutzerid', '=', $userid)
                ->where('gerichtid', '=', $_GET['gerichtid'])->delete();
        }
        header("Location: /meinebewertungen");
    }

    public function highlight()
    {
        echo 'gericht:' . $_GET['gerichtid'] . '<br>' . 'Benutzer:' . $_GET['benutzerid'];
        if (isset($_SESSION['email']))
            $user = getUser($_SESSION['email']);

        if (!isset($_SESSION['login']) || !$user['admin'])
            header("Location: /");

        if (isset($_GET['highlight']) && isset($_GET['gerichtid']) && isset($_GET['benutzerid'])) {
            highlight($_GET['highlight'], $_GET['gerichtid'], $_GET['benutzerid']); //Eloquent doesn't support Composite keys, how do I update? where(X)->where(Y)->get() doesn't work, ->first() doesn't work either
        }

        header("Location: /bewertungen");
    }

    public function newsletter()
    {
        $vorname = $_POST['newsletter_vorname'] ?? null;
        $email = $_POST['newsletter_mail'] ?? null;
        $lang = $_POST['newsletter_lang'] ?? null;

        if($vorname != null && $email != null && $lang != null) {
            $newsletter = NewsletterAR::firstOrNew(['email' => $email]);
            $newsletter->vorname = $vorname;
            $newsletter->email = $email;
            $newsletter->sprache = $lang;
            $newsletter->save();
        }

        header('Location: /');
    }
}