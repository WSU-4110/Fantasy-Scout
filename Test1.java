import static org.junit.jupiter.api.Assertions.*;

import org.junit.jupiter.api.AfterAll;
import org.junit.jupiter.api.AfterEach;
import org.junit.jupiter.api.BeforeAll;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;

class Assignment6Test {

	@BeforeAll
	static void setUpBeforeClass() throws Exception {
	}

	@AfterAll
	static void tearDownAfterClass() throws Exception {
	}

	@BeforeEach
	void setUp() throws Exception {
	}

	@AfterEach
	void tearDown() throws Exception {
	}
	
	//In all test cases correct value is on left, comment on right
	java.lang.Object
		java.net.URLConnection
	@Test
	void testGetURL() {
		
		//Test URL names
		String URLname="google.com";
		String URLname1="bing.com";
		String URLname2="yahoo.com";
		
		HttpURLConnection huc1 = (HttpURLConnection) URLname1.openConnection();
		HttpURLConnection huc2 = (HttpURLConnection) URLname2.openConnection();
		HttpURLConnection huc3 = (HttpURLConnection) URLname3.openConnection();
		
		//Checks the error code of not loaded website against the loaded website to ensure get driver is functioning properly
		Assert.assertTrue(False,(asserEquals(HttpURLCOnnection.HTTP_NOT_FOUND, huc1.getResponseCode())),(driver.get(URL1)),"Checking page loading posssibility");
		Assert.assertTrue(False,(asserEquals(HttpURLCOnnection.HTTP_NOT_FOUND, huc2.getResponseCode())),(driver.get(URL2)),"Checking page loading posssibility");
		Assert.assertTrue(Trualse,(asserEquals(HttpURLCOnnection.HTTP_NOT_FOUND, huc3.getResponseCode())),(driver.get(URL3)),"Checking page loading posssibility");
	}
	
	@Test
	void testFindElement() {
		//Sample html id known to be on webpage to ensure it works, using search bar
		String googleID="searchform";
		String bingID="sb_form_q";
		String yahooID="ybar";
		
		String URLnameIDTEST="google.com";
		String URLnameIDTEST1="bing.com";
		String URLnameIDTEST2="yahoo.com";
		
		driver.get(URLnameIDTEST);
		Assert.assertEqual(googleID,(driver.findElement(By.cssSelector('#id=searchform')),"Checking for element on page");
		
		driver.get(URLnameIDTEST1);
		Assert.assertEqual(bingID,(driver.findElement(By.cssSelector('#id=sq_form_q')),"Checking for element on page");
		
		driver.get(URLnameIDTEST2);
		Assert.assertEqual(yahooID,(driver.findElement(By.cssSelector('#id=ybar')),"Checking for element on page");
	}
	
	@Test
	void testClick() {
		//Sample html id known to be on webpage to ensure it works, using search bar
				String googleCLick="searchform";
				String bingClick="0 0 25 25";
				String yahooClick="ybar";
				
				String URLnameIDTEST="google.com";
				String URLnameIDTEST1="bing.com";
				String URLnameIDTEST2="yahoo.com";
				
				driver.get(URLnameIDTEST);
				Assert.assertEqual((driver.findElement(By.cssSelector('#name=btnk')),googleIDClick,"Checking for element on page");
				
				driver.get(URLnameIDTEST1);
				Assert.assertEqual((driver.findElement(By.cssSelector('#viewBox=0 0 25 25')),bingIDClick,"Checking for element on page");
				
				driver.get(URLnameIDTEST2);
				Assert.assertEqual((driver.findElement(By.cssSelector('#value=search')),yahooIDClick,"Checking for element on page");
	}
	


}
