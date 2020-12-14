package FanScouts;

import static org.junit.jupiter.api.Assertions.*;
import org.junit.jupiter.api.*;

class FanDataTest {

	@BeforeAll
	static void setUpBeforeClass() throws Exception {
		
	}
	
	@AfterAll
	static void tearDownAfterClass() throws Exception {
		
	}
	
	@BeforeEach
	void setUp() throws Exception {
		
	}
	
	@Test
	public void testResetScore() {
		FanData fd = new FanData();
		assertEquals(0 , fd.resetScore());
		assertNotEquals(0.1 , fd.resetScore()); 
	}
	
	@Test
	public void testAverageScore() {
		FanData fd = new FanData();
		assertEquals(2, fd.scoreAverage(1,3));
		assertEquals(5, fd.scoreAverage(1,10)); //we want to round down

	}
	
	@Test
	public void testpickBest() {
		FanData fd = new FanData();
		assertEquals(3, fd.pickBest(1,3));
		assertEquals(3, fd.pickBest(3,3)); //works in tie as we would want to return both
	}
	
	@Test
	public void testpickWorst() {
		FanData fd = new FanData();
		assertEquals(1, fd.pickWorst(1,3));
		assertEquals(1, fd.pickWorst(1,1)); //works in tie as we would want to return both

	}
	
	@Test
	public void testGiveHighestRankt() {
		FanData fd = new FanData();
		assertEquals('S', fd.giveHighestRank(10));
		assertNotEquals('N', fd.giveHighestRank(10)); //test for failures
	}
	
	@Test
	public void testGiveLowestRankt() {
		FanData fd = new FanData();
		assertEquals('F', fd.giveLowestRank(0));
		assertNotEquals('S', fd.giveLowestRank(0)); //test for failures

	}
	
		
}
