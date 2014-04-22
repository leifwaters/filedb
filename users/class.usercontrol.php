<?php


/**
 * UserControl class.
 *
 * Used to create, manage, login, and handle user access
 *
 * @author Michael Bryan
 * @version 0.0.10
 *
 * @TODO
 */
class UserControl {


	/**
	 * config
	 *
	 * General config options for the class including the database
	 *
	 * @var mixed
	 * @access private
	 * @TODO move the database info into a seperate DB handler class
	 */
	private $config = array(
		'dbhost'   => 'localhost',
		'dbuser'   => 'root',
		'dbpass'   => 'root',
		'db'       => 'filedb',
		'site_url' => 'http://localhost/daccz',
		'salt'     => 'sdflkj423qltq4fq354ymvq89qo34ngvqcmp459y3von8octhmw590pmqt48cqov34q0n354vmy8cqovmc49vy9no4c9mtpqnov853cm4iyg5jv8ony',
	);

	/**
	 * error
	 *
	 * Used to group any errors that occur into an array for the getError() method
	 *
	 * (default value: null)
	 *
	 * @var mixed
	 * @access public
	 */
	public $error = null;


	/**
	 * success
	 *
	 * Used to group any successes that occur into an array for the getSuccess() method
	 *
	 * (default value: null)
	 *
	 * @var mixed
	 * @access public
	 */
	public $success = null;

	/**
	 * showUserField
	 *
	 * Used when a specified username is taken. Checked on new_user.php to display field.
	 *
	 * (default value: null)
	 *
	 * @var mixed
	 * @access public
	 */
	public $showUserField = null;

	/**
	 * db
	 *
	 * Acts weird without this
	 *
	 * @var mixed
	 * @access private
	 * @TODO this needs to go when the DB handler class is created
	 */
	private $db;

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct($level = 75, $page = null) {
		session_start();

		foreach($this->config as $key => $value){
        	$this->{$key} = $value;
		}

		try {
		  $this->db = new PDO('mysql:host='.$this->dbhost.';dbname='.$this->db, $this->dbuser, $this->dbpass);
		}
		catch(PDOException $e) {
		    echo $e->getMessage();
		}

		if(isset($_COOKIE['hash'])) {
			if(defined($_COOKIE['hash'])) {
				if($_SESSION[$_COOKIE['hash']]->level >= $level) {
					$this->error[] = 'You do not have permission to access this page.';
				} else {

				}

			}
		} elseif($page != 'login') {
			header("Location: ".$this->site_url."/users/login.php");
		}
	}

	/**
	 * login function.
	 *
	 * @access public
	 * @param mixed $username
	 * @param mixed $password
	 * @return void
	 */
	public function login($username, $password, $page = null) {
		$hash = sha1($username);
		$stmt = $this->db->prepare('SELECT * FROM `users` WHERE `login_hash`=:hash');
		$stmt->bindParam(':hash', $hash);
		$stmt->execute();

		try {
			$user = $stmt->fetch(PDO::FETCH_OBJ);
			if($username === $user->username && crypt($password, $this->salt) === $user->password) {
				setcookie("hash", $user->login_hash, time()+1800, '/');

				$_SESSION[$user->login_hash] = $user;

				if($page !== null) {
					header('Location:'.$this->site_url.'/'.$page);
				}

				return true;
			} else {
				$this->error[] = 'Your username or password is incorrect. Please try again.';
				return false;
			}
		} catch(PDOException $e) {
		    echo $e->getMessage();
		}
	}

	public function logout() {

	}

	public function user() {
		// Make some stuff here for shortcuts to the session stuff
		// see about accessing stuff like $auth->user()->firstName;
	}

	/**
	 * create_user function.
	 *
	 * Used to create a new user and insert it into the database.
	 * Usage: UserControl::create_user($password, $passconfirm, $firstName, $lastName, $level);
	 * The username is generated using the first and last name. If the user is John Doe the generated username would be jDoe.
	 * Comes with some general validation out of the box.
	 *
	 * @access public
	 * @param mixed $user (default: null)
	 * @param mixed $password
	 * @param mixed $passconfirm
	 * @param mixed $firstName
	 * @param mixed $lastName
	 * @param mixed $level
	 * @return void
	 *
	 * @TODO possibly add a memberOf or hasAccess option to specify what can and can not be accessed
	 * @TODO add a check to see a username is currently in the database
	 */
	public function create_user($password, $passconfirm, $firstName, $lastName, $level, $user = null) {

		// Trust No One
		// So let's validate the input of those pesky users

		// Check for password strength and matching
		// Min 6 characters
		// at least 1 number
		// at least 1 letter
		// Allow special characters
		if(!preg_match('/^(?=.*[^a-zA-Z])(?=.*[a-z])(?=.*[A-Z])\S{6,}$/', $password)) {
			$this->error[] = 'Your password does not meet the requirements.';
		} elseif($password !== $passconfirm) {
			$this->error[] = 'Your passwords do not match.';
		} else {
			$password_hash = crypt($password, $this->salt);
		}

		// Check that firstName and lastName are only letters
		// Cause c'mon, who the fuck has numbers or special characters in their name?
		if(!preg_match('/^([a-zA-Z]+\s)*[a-zA-Z]+$/', $firstName)) {
			$this->error[] = 'No numbers or special characters in a name.';
		}
		if(!preg_match('/^([a-zA-Z]+\s)*[a-zA-Z]+$/', $lastName)) {
			$this->error[] = 'No numbers or special characters in a name.';
		}

		// And level should be an integer, nothing else
		if(!is_numeric($level)) {
			$this->error[] = 'Whoa, level should be numeric only. You should also never see this error so let B&amp;B know.';
		}

		// I alone determine what usernames will be
		if($user === null) {
			$user = substr(lcfirst($firstName), 0, 1).ucfirst($lastName);
		}

		// And therefore they must be checked
		if(!$this->isUnique($user)) {
			$this->showUserField = $user;
		}

		// Create a hash for this user by sha1 on the username
		$hash = sha1($user);

		// Now we're in the nitty gritty
		// Let's upload our validated user

		if(empty($this->error)) {
			try{
				$stmt = $this->db->prepare("INSERT INTO users (`username`, `password`, `firstName`, `lastName`, `level`, `login_hash`) value (:username, :password, :firstName, :lastName, :level, :hash)");
				$stmt->bindParam(':username', $user);
				$stmt->bindParam(':password', $password_hash);
				$stmt->bindParam(':firstName', $firstName);
				$stmt->bindParam(':lastName', $lastName);
				$stmt->bindParam(':level', $level);
				$stmt->bindParam(':hash', $hash);
				$stmt->execute();
				$this->success['created'] = $user.' was created!';
			}
			catch(PDOException $e) {
				$this->error[] = "Something went wrong with the database when trying to add a user.";
	    		file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
			}

			$this->closeDB();
		}

	}


	/**
	 * isUnique function.
	 *
	 * Checks to make sure a username isn't already in the database.
	 *
	 * @access private
	 * @param mixed $username
	 * @return void
	 */
	private function isUnique($username) {
		try{
			$stmt = $this->db->prepare('SELECT id FROM `users` WHERE `username`=:username');
			$stmt->bindParam(':username', $username);
			$stmt->execute();
			$rows = $stmt->rowCount();
			if($rows > 0) {
				$this->error[] = 'The username is currently in use.';
				return false;
			}
		}
		catch(PDOException $e) {
			$this->error[] = "Something went wrong with the database when trying to check for a username.";
    		file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		}
	}

	/**
	 * getSuccess function.
	 *
	 * @access public
	 * @return void
	 */
	public function getSuccess() {
		if(!$this->success) {
			return false;
		} else {
			return $this->success;
		}
	}


	/**
	 * getErrors function.
	 *
	 * @access public
	 * @return void
	 */
	public function getErrors() {
		if(!$this->error) {
			return false;
		} else {
			return $this->error;
		}
	}


	/**
	 * closeDB function.
	 *
	 * @access private
	 * @return void
	 */
	private function closeDB() {
		$db = null;
	}

}


?>