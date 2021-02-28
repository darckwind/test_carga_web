package computerdatabase

import io.gatling.core.Predef._
import io.gatling.http.Predef._
import scala.util.Random
import scala.collection.mutable.ArrayBuffer

import scala.concurrent.duration._
import java.io.File

import com.typesafe.config.{Config, ConfigFactory}

class Example_File extends Simulation {

  val config = ConfigFactory.parseFile(new File("src/test/resources/data.conf"))

  val anws = ArrayBuffer[String]()

  def patern_anws() ={
    val src = scala.io.Source.fromFile("src/test/resources/anwser_patern.csv").getLines
    val headerLine = src.take(1).next

    for(l <- src) {
      // split line by comma and process them
      l.split(",").map { c =>
        anws+= c.toString
      }
    }
  }


  def rand_anws(): String = {
    var answers = Array("1", "2", "3", "4")
    var random_answer = "A" + answers(Random.nextInt(answers.length))
    return random_answer.toString
  }
  def rand_feed_anws()={
    for( w <- 0 to 100){
      anws+= rand_anws()
    }
  }

  if(config.getString("anw_rand").toInt== 0){
    patern_anws()
  }else{
    rand_feed_anws()
  }


  var question_counter_offset = 2
  val nbUsers = Integer.getInteger("users", 1)
  val nbDuration = Integer.getInteger("Dmaxduration", 60)

  val httpProtocol = http
    .baseUrl(config.getString("url_base"))
    .userAgentHeader("Apache-HttpClient/4.5.5 (Java/1.8.0_191)")
    .header("Connection", "keep-alive")
    .disableCaching // no caching

  val scn = scenario("TestToEnd")
    .feed(csv(config.getString("csv_file")).queue)
    .exec(flushCookieJar) // flush all cookies

    //copy here the requests from the stage

  if(config.getString("ramp_usr").toInt== 0){
    setUp(scn.inject(atOnceUsers(config.getString("n_user").toInt)).protocols(httpProtocol))
  }else{
    setUp(scn.inject(atOnceUsers(config.getString("n_user").toInt, rampUsers(config.getString("ramp_usr").toInt).during(10.seconds))).protocols(httpProtocol))
  }
  
}
