import static org.junit.jupiter.api.Assertions.*;

import java.sql.Date;

import org.junit.jupiter.api.AfterAll;
import org.junit.jupiter.api.AfterEach;
import org.junit.jupiter.api.BeforeAll;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;

class Test2 {

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

	@Test
	void dateTest1() {
		Date d=new Date(2020,1,1);
		d.addDays(10);
		assertEquals(1,d.getYear(),2020);
		assertEquals(1,d.getMonth(),2);
		assertEquals(1,d.getDay(),11);
		
	}
	
	@Test
	void dateTest2() {
		Date d=new Date(2020,1,1);
		d.getDay( );
		assertEquals(1,d.getDay(),1)
	}
	
	@Test
	void dateTest3() {
		Date d=new Date(2020,1,1);
		d.daysInMonth( );
		assertEquals(31d.daysInMonth(),1);
	}

}
